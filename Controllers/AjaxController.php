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

        //获取页数量
        $page = (int)$_POST['page'];
        //获取每一页的数量
        $limit = (int)$_POST['limit'];
        //计算偏移量
        $offset = ($page - 1) * $limit;


        //使用POD连接数据库
        $PDO = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWD);


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
WHERE 
    (newshop.sname LIKE :sname 
OR 
    newshop.sid LIKE :sid)
';

        if (!empty($_POST['declare_date'])) {
            $sqlA .= ' AND  newshop.declare_date = :declare_date';
        }
        if (!empty($_POST['open_date'])) {
            $sqlA .= ' AND  newshop.open_date = :open_date';
        }
        if (!empty($_POST['office'])) {
            $sqlA .= ' AND  newshop.office = :office';
        }

        if (!empty($_POST['state'])) {
            $sqlA .= ' AND  newshop.state = :state';
        }


        $sqlL .= ' ORDER BY newshop.open_date DESC LIMIT :offset, :rows';

        $sqlC = '
SELECT
count(*)
FROM
	newshop
WHERE 
    (newshop.sname LIKE :sname 
OR 
    newshop.sid LIKE :sid)
';

        $sql  .= $sqlA;
        $sql  .= $sqlL;
        $sqlC .= $sqlA;

//        var_dump($sqlC);


        $num = $PDO->prepare($sqlC);
        $num->bindValue(':sname', '%' . $_POST['shop'] . '%');
        $num->bindValue(':sid', '%' . $_POST['shop'] . '%');
        if (!empty($_POST['declare_date'])) {
            $num->bindValue(':declare_date', $_POST['declare_date']);
        }
        if (!empty($_POST['open_date'])) {
            $num->bindValue(':open_date', $_POST['open_date']);
        }
        if (!empty($_POST['office'])) {
            $num->bindValue(':office', $_POST['office']);
        }
        if (!empty($_POST['state'])) {
            $num->bindValue(':state', $_POST['state']);
        }
        $num->execute();
        $N = $num->fetch();


        $sth = $PDO->prepare($sql);
        $sth->bindParam(':offset', $offset, PDO::PARAM_INT);
        $sth->bindParam(':rows', $limit, PDO::PARAM_INT);
        $sth->bindValue(':sname', '%' . $_POST['shop'] . '%');
        $sth->bindValue(':sid', '%' . $_POST['shop'] . '%');
        if (!empty($_POST['declare_date'])) {
            $sth->bindValue(':declare_date', $_POST['declare_date']);
        }
        if (!empty($_POST['open_date'])) {
            $sth->bindValue(':open_date', $_POST['open_date']);
        }
        if (!empty($_POST['office'])) {
            $sth->bindValue(':office', $_POST['office']);
        }
        if (!empty($_POST['state'])) {
            $sth->bindValue(':state', $_POST['state']);
        }

        $sth->execute();
        $count = $sth->fetchAll(PDO::FETCH_ASSOC);
        $num   = count($count);
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


}// End of the class DemoController
// End of file democontroller.php