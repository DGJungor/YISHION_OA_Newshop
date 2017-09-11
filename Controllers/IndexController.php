<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/24
 * Time: 15:58
 */



// controller/democontroller.php
class IndexController
{
    // private $data = 'Hello furzoom!';
    function Index()
    {


        require('View/index.php');
        $view = new Index();
        $view->display();

    }
}// End of the class DemoController
// End of file democontroller.php