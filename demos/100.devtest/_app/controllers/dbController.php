<?php
/**
 * ------------------------------------------------------------------------------
 * test 控制器
 * ------------------------------------------------------------------------------
 * @version 3.0
 * @author  WangXian
 * @creation date 2010-8-12
 * @Modified date 2010-12-30
 * ------------------------------------------------------------------------------
 */

class dbController extends controller
{
	function __construct()
	{

	}

	public function testAction()
	{
		// $where = "id=? and name=?";
		// $arr = [1, "2010-12-30"];
		// $i = 0;
		// dump(preg_replace_callback(["/(\?)/"], function() use (&$i, &$arr) {
		// 	dump($arr);
		// 	return '"'. $arr[$i++] .'"';
		// }, $where));

		// // dump(str_replace("/(\?)/", [1,2], $where));
		// exit;

		$m = new model;

		// $m->where("id=? and name=?", [12, "' or 1=1"]);
		// $m->table("t_test")->set("ttrr=?", ["wangxian"])->where("id>?", [5])->update();

		// 错误，insert set(array $data) 必须是array类型
		// $m->table("t_test")->set("name=?, ttrr=?", ["wx", "wangxian"])->insert();

		// 正确
		// $m->table("t_test")->set(["name" => "wx", "ttrr" => "wangxian"])->insert();

		// query支持查询参数未知替换
		dump($m->query("select * from t_test where name=?", ["wx"])->findAll());

		dumpdie($m->getLastSql());
	}

	/** 测试跨model的mysql资源语柄共享 */
	public function db1Action()
	{
		//C('dbdriver','main','mysql');
		$t1 = new t1Model();
		dump($t1->getOne());

		$t2 = new t2Model();
		dump($t2->getOne());
	}

	public function insertAction()
	{
		$t1 = new t1Model();
		dump($t1->add_data('WangXian！@#￥%……&*\'";.,/\''));
		echo $t1->getLastSql();
	}

	public function db2Action()
	{
		$this->model_t1->getOne();
		$this->model_t1->getOne();
	}
}

/* End of file dbController.php */
/* Location: ./_app/controllers/dbController.php */