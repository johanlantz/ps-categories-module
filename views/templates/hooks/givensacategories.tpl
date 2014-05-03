<div class="givensatagmenu" style="clear:both">	
		{if isset($myCategoriesToShow) AND $myCategoriesToShow|@count > 0} 
			<ul>
				<li class={if ($my_id_category_current == $my_id_all_products_category)} "tagmenuitemselected" {else} "tagmenuitem" {/if}>
					<span id="catcol catid{$my_id_all_products_category}">
							<a href="{$link->getCategoryLink($my_id_all_products_category, $category.link_rewrite)|escape:'htmlall':'UTF-8'}" class="topcatname">
								{l s='All Products' mod='givensacategories'}
							</a>
					</span>	
				</li>
				{foreach $myCategoriesToShow as $category_walker}
					<li class={if ($my_id_category_current == $category_walker.id_category)} "tagmenuitemselected" {else} "tagmenuitem" {/if}>
						<span id="catcol catid{$category_walker.id_category}">
							<a href="{$link->getCategoryLink($category_walker.id_category, $category.link_rewrite)|escape:'htmlall':'UTF-8'}" class="topcatname">
								{$category_walker.name}
							</a>
						</span>
					</li>
				{/foreach}
			</ul>
		{/if}
</div>	