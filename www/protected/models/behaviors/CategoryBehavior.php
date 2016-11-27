<?php
class CategoryBehavior extends CActiveRecordBehavior {

	
	public $result = array();

	public function createCategoryTreeData() {
		$roots = Category::model()->roots()->findAll();
		//$result = array();
		foreach ($roots as $root) {
			$this->printNode($root);
		}
		return $this->result;
	}

	public function printNode($parentNode) {
		$children = $parentNode->children()->findAll();
		if (count($children)>0) {
			$this->result[$parentNode->id] = str_repeat("-", $parentNode->level-1).$parentNode->name;
			foreach ($children as $child) {
				$this->printNode($child);
			}
		} else {
			$this->result[$parentNode->id] = str_repeat("-", $parentNode->level-1).$parentNode->name;
		}
	}

	public function saveToParent($parentId) {
		$model = $this->owner;
		if($model->isNewRecord){
			if($parentId==='0'){
				return $model->saveNode();
			} else {
				$parent = Category::model()->findByPk($parentId);
				if($parent){
					return $model->appendTo($parent);
				} else {
					return false;
				}
			}
		} else {
			if($parentId != $model->ParentId){
				if($parentId === '0'){
					return $model->moveAsRoot();
				} else {
					$parent = Category::model()->findByPk($parentId);
					return $model->moveAsLast($parent);
				}
			} else {
				return $model->saveNode();
			}
		}
	}

	public function getParentId() {
		if ($this->owner->isRoot() || $this->owner->isNewRecord) {
			return 0;
		} else {
			return $this->parent->id;
		}
	}

	public function getParent() {
    return $this->owner->parent()->find();
  }

}
?>