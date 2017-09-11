<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/24
 * Time: 15:58
 */


require_once 'Config/MySQL.php';

class AjaxController
{
    // private $data = 'Hello furzoom!';
    function SelectIndex()
    {

        //获取页数量
        $page = (int)$_GET['page'];
        //获取每一页的数量
        $limit = (int)$_GET['limit'];
        //计算偏移量
        $offset = ($page - 1) * $limit;



        //使用POD连接数据库
        $PDO = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWD);

        //PDO 获取报表总条数
        $sthN = $PDO->query('
SELECT
COUNT(*)
FROM
newshop
');
        $N    = $sthN->fetch();

        //获取查询数据
        $sql = '
SELECT
	newshop.id,
	newshop.office,
	newshop.sid,
	newshop.sname,
	newshop.declare_date,
	newshop.open_date,
	newshop.state,
	newshop.dep
FROM
	newshop
ORDER BY
	newshop.open_date DESC
LIMIT :offset, :rows
';
        $sth = $PDO->prepare($sql);
        $sth->bindParam(':offset', $offset, PDO::PARAM_INT);
        $sth->bindParam(':rows', $limit, PDO::PARAM_INT);
        $sth->execute();
        $count = $sth->fetchAll(PDO::FETCH_ASSOC);
        //关闭PDO数据库
        $PDO = null;

        //数据中加入状态的中文
        foreach ($count as $v => $k) {
            switch ($k['office']) {
                case 1:
                    $count[$v]['officeCN'] = '广东办事处';
                    break;
                case 2:
                    $count[$v]['officeCN'] = '四川办事处';
                default;
            }

        }

        $res['code']  = 0;
        $res['msg']   = '';
        $res['count'] = $N[0];
        $res['data']  = $count;
        $res          = json_encode($res);

        echo $res;

    }

    public function Search()
    {
        $res = json_encode($_POST);
        echo $res;
    }



}// End of the class DemoController
// End of file democontroller.php