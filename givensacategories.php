<?php 
/*
* Givensa Categories+
* Copyright (C) 2014 Givensa
* 
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if (!defined('_PS_VERSION_'))
  exit;
 
class GivensaCategories extends Module
{
	// DB file
	const INSTALL_SQL_FILE = 'install.sql';
	protected $category;

	public function __construct()
	{
		$this->name = 'givensacategories';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'givensa';
		$this->need_instance = 0;
		$this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.6'); 
		// $this->dependencies = array('blockcart');

		parent::__construct();

		$this->displayName = $this->l('Givensa Categories');
		$this->description = $this->l('Category list.');

		$this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
	}

	/**
 	 * install
	 */
	public function install()
	{
		// Create DB tables - uncomment below to use the install.sql for database manipulation
		/*
		if (!file_exists(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE))
			return false;
		else if (!$sql = file_get_contents(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE))
			return false;
		$sql = str_replace(array('PREFIX_', 'ENGINE_TYPE'), array(_DB_PREFIX_, _MYSQL_ENGINE_), $sql);
		// Insert default template data
		$sql = str_replace('THE_FIRST_DEFAULT', serialize(array('width' => 1, 'height' => 1)), $sql);
		$sql = str_replace('FLY_IN_DEFAULT', serialize(array('width' => 1, 'height' => 1)), $sql);
		$sql = preg_split("/;\s*[\r\n]+/", trim($sql));

		foreach ($sql as $query)
			if (!Db::getInstance()->execute(trim($query)))
				return false;
		*/

		if (!parent::install() || 
			!$this->registerHook('displayTop') || 
			!$this->registerHook('displayHeader') || 
			!$this->registerHook('displayBackOfficeHeader') || 
			!$this->registerHook('displayAdminHomeQuickLinks'))
			return false;
		return true;
	}

	/**
 	 * uninstall
	 */
	public function uninstall()
	{
		if (!parent::uninstall())
			return false;
		return true;
	}

	/**
 	 * admin page
	 */	
	public function getContent()
	{
		return $this->display(__FILE__, 'views/templates/admin/givensacategories.tpl');
	}

	// BACK OFFICE HOOKS

	/**
 	 * admin <head> Hook
	 */
	public function hookDisplayBackOfficeHeader()
	{
		// CSS
		$this->context->controller->addCSS($this->_path.'views/css/elusive-icons/elusive-webfont.css');
	}

	/**
	 * Hook for back office dashboard
	 */
	public function hookDisplayAdminHomeQuickLinks()
	{	
		$this->context->smarty->assign('givensacategories', $this->name);
	    return $this->display(__FILE__, 'views/templates/hooks/quick_links.tpl');    
	}

	// FRONT OFFICE HOOKS

	/**
 	 * <head> Hook
	 */
	public function hookDisplayHeader()
	{
		// CSS
		$this->context->controller->addCSS($this->_path.'views/css/'.$this->name.'.css');
	}

/**
	 * Assign template vars related to category
	 */
	protected function givensaAssignCategory()
	{
		$this->category = new Category(Tools::getValue('id_category'), $this->context->language->id);
		// Assign category to the template
		if ($this->category !== false && Validate::isLoadedObject($this->category) && $this->category->inShop() && $this->category->isAssociatedToShop())
		{
			$path = Tools::getPath($this->category->id, $this->product->name, true);
			$this->context->smarty->assign(array(
				'myCategory' => $this->category,
				'mySubCategories' => $this->category->getSubCategories($this->context->language->id, true),
				'my_id_category_current' => (int)$this->category->id,
				'my_id_category_parent' => (int)$this->category->id_parent,
				'my_return_category_name' => Tools::safeOutput($this->category->name)
			));
		}
	}
	/**
 	 * Top of pages hook
	 */
	public function hookDisplayTop($params)
	{	
		$this->givensaAssignCategory();
		
		return $this->display(__FILE__, 'views/templates/hooks/category.tpl');
	}

	/**
 	 * Footer hook
	 */
	public function hookDisplayFooter($params)
	{
		// JS
		$this->context->controller->addJS($this->_path.'views/js/'.$this->name.'.js');
	}
}

?>
