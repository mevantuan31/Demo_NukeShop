<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 31 Oct 2020 02:20:33 GMT
 */

if (!defined('NV_IS_MOD_SAMPLES')) {
    die('Stop!!!');
}

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];

$array_data = [];
$post=[];
$error=[];
$product_ids = [];
$product_quantities = [];

function check_input($data) {
    $data = trim($data); 
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$result2 = $db->query("SELECT total_product, total_price  FROM `nv4_orders2` WHERE id =" . $order_id);
        $row2 = $result2->fetch();
        $total2['total_product'] = $row2['total_product'];
        $total2['total_price'] = $row2['total_price'];


$cart_item_id = $nv_Request->get_int('id', 'post', 0);
$cart_item_action = $nv_Request->get_title('action', 'post', '');
$post['id'] = $cart_item_id;
$post['customer_name'] = $nv_Request->get_title('customer_name', 'post', '');
$post['customer_email'] = $nv_Request->get_title('customer_email', 'post', '');
$post['customer_phone'] = $nv_Request->get_title('customer_phone', 'post', '');
$post['customer_address'] = $nv_Request->get_title('customer_address', 'post', '');
$post['order_status'] = $nv_Request->get_title('order_status', 'post', '');
$post['order_note'] = check_input($nv_Request->get_title('order_note', 'post', ''));
$post['total_product'] = $nv_Request->get_title('total_product', 'post', '');
$post['total_price'] = check_input($nv_Request->get_title('total_price', 'post', ''));

$product_quantities = $nv_Request->get_typed_array('product_quantity','post', '');

$product_ids = $nv_Request->get_typed_array('product_ids','post', '');




/*session Giỏ hàng */
if(!empty($post))
{
    if(!empty($post['action']))
    {
        switch($post['action'])
        {
            case 'add' :
                if($cart_item_id > 0)
                {
                    $sql = "SELECT * FROM `nv4_product` WHERE id=" . $post['id'];
                    $product = $db->query($sql)->fetch();
                    if (!empty($product['product_image'])) 
                    {
                        $product['product_image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $product['product_image'];

                    }
                    
                    $product_id = $product['id'];
                    if (!empty($_SESSION['cart_item']))
                    {
                        if (isset($_SESSION['cart_item'][$product_id]))
                        {
                            //sản phẩm đã tồn tại trong giỏ hàng
                            echo 'sản phẩm đã tồn tại trong giỏ hàng';
                            die();
                        } else {
                            //Sản phẩm chưa tồn tại trong giỏ hàng
                                //gán biến cart_item bằng array thông tin sản phẩm người dùng muốn thêm vào giỏ hàng
                            $cart_item = array();
                            $cart_item['id'] = $product['id'];
                            $cart_item['product_name'] = $product['product_name'];
                            $cart_item['product_image'] = $product['product_image'];
                            $cart_item['product_price'] = $product['product_price'];
                            $cart_item['product_quantity'] = 1; 
                            //cập nhật session của sản phẩm vừa thêm vào giỏ hàng
                            $_SESSION['cart_item'][$product_id] = $cart_item;
                            
                            die('Thêm sản phẩm vào giỏ hàng thành công');
                        }
                    }  else {
                        // gán dữ liệu cho $_SESSION['cart_item'] khi chưa có dữ liệu
                        $_SESSION['cart_item'] = array();
                        $product_id = $product['id'];
                        //gán biến cart_item bằng array thông tin sản phẩm người dùng muốn thêm vào giỏ hàng
                        $cart_item = array();
                        $cart_item['id'] = $product['id'];
                        $cart_item['product_name'] = $product['product_name'];
                        $cart_item['product_image'] = $product['product_image'];
                        $cart_item['product_price'] = $product['product_price'];
                        $cart_item['product_quantity'] = 1; 
                        $_SESSION['cart_item'][$product_id] = $cart_item;
                        die('Thêm sản phẩm vào giỏ hàng thành công');

                    }
                }
                break;
            case 'remove' :
                if($post['id'] > 0)
                {
                    $product_id = $post['id'];
                    if (isset($_SESSION['cart_item'][$product_id]))
                        {
                            //hủy id của sản phẩm cần xóa
                            unset($_SESSION['cart_item'][$product_id]);
                        }
                }
                break;
            default:
                echo 'action không tồn tại';
                die;
                
        }
    }
}
/* End session giỏ hàng */

/* create order */
if(!empty($post['submit']))
{
    if (empty($post['customer_name']))
    {
        $error[] = 'Vui lòng nhập tên người nhận hàng';
    }
    if (empty($post['customer_email']))
    {
        $error[] = 'Vui lòng nhập email';
    } else if (!preg_match("/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/i", $post['customer_email'])){
        $error[] = 'Email không đúng định dạng';
    }
    if (empty($post['customer_phone']))
    {
        $error[] = 'Vui lòng nhập số điện thoại';
    } else if ((!preg_match('/[0-9][^#&<>\"~;$^%{}?a-zA-Z]{9,10}$/', $post['phone'])) || !is_numeric($post['customer_phone'])) {
        $error[] = 'số điện thoại không đúng định dạng';
    }
    if (empty($post['customer_address']))
    {
        $error[] = 'Vui lòng nhập địa chỉ nhận hàng';
    }
    if (!empty($product_ids) && !empty($product_quantities))
    {
        $post['total_price'] = 0;
        foreach($product_ids as $product_ids_key => $productId) {
            //
            $quantity = $product_quantities[$product_ids_key];
            $sql = "SELECT * FROM `nv4_product` WHERE id=" . $productId;
            $product = $db->query($sql)->fetch();
            $totalPriceProduct = $quantity*$product['product_price'];
            $post['total_price'] += $totalPriceProduct;
        }
    } else {
        $error[] = 'Bạn chưa nhập số lượng sản phẩm';
    }
    

    if (empty($error))
    {
        
            $sql = "INSERT INTO `nv4_orders2` (`customer_name`,`customer_email`,`customer_phone`,`customer_address`,`total_price`,`order_note`,`order_status`)  
                    VALUES (:customer_name, :customer_email, :customer_phone, :address, :total_price, :order_note, :order_status)";
            $s = $db->prepare($sql);
                $s->bindParam('customer_name', $post['customer_name']);
                $s->bindParam('customer_email', $post['customer_email']);
                $s->bindParam('customer_phone', $post['customer_phone']);
                $s->bindValue('customer_address', $post['customer_address']
                $s->bindValue('total_price', $post['total_price']);
                $s->bindParam('order_note', $post['order_note']);
                $s->bindValue('order_status', 1);
                if ($s->execute())
                {
                    //lấy ra id vừa insert
                    $order_id = $db->lastInsertId();
                   
                    foreach($product_ids as $product_ids_key => $productId) {
                        //creat order_detail
                        $quantity = $product_quantities[$product_ids_key];
                        $sql = "SELECT price FROM `nv4_product` WHERE id=" . $productId;
                        $product = $db->query($sql)->fetch();
                            $sql = "INSERT INTO `nv4_orderdetail2` (`order_id`,`product_id`,`quantity`,`product_price`)  VALUES (:order_id, :product_id, :quantity, :product_price)";
                            $s = $db->prepare($sql);
                            $s->bindValue('order_id', $order_id);
                            $s->bindValue('product_id', $productId);
                            $s->bindValue('quantity', $quantity);
                            $s->bindValue('product_price', $product['product_price']);
                            $s->execute();

                            $alert = 'Đặt hàng thành công';
                    }
                    
                }
                
        
    }
}
/* End create order*/

/* if ($cart_item_id > 0)
{
    $post = serialize($post);
     $post = json_encode($post);
    $nv_Request->set_Session("cart_item", $post);
    $post2 = $nv_Request->get_title('cart_item', 'session', '');
    if($post2 !='') {
        $post2 = json_decode($post2,true);
        print_r($post2);die;
    }
    
    die('ERR'); 
     $_SESSION['cart_item'][$cart_item_id] = $post;
    echo "<pre>";
    print_r($_SESSION['cart_item']);
    echo "</pre>";
    die(); 

} */

$contents = nv_theme_category_cart($array_data, $result, $error, $alert, $post);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
