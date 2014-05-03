<div class="givensatagmenu" style="clear:both">	
		{if isset($mySubCategories) AND $mySubCategories|@count > 0} 
			<ul>
				<li class="tagmenuitem">
					<span id="catcol catid{$catid}">
							<a href="{$link->getCategoryLink($my_id_category_current, $category.link_rewrite)|escape:'htmlall':'UTF-8'}" class="topcatname">
								{l s='All Products' mod='givensacategories'}
							</a>
					</span>	
				</li>
				{foreach $mySubCategories as $current_category}
					{$catid=$current_category.id_category}
					<li class="tagmenuitem">
						<span id="catcol catid{$catid}">
							<a href="{$link->getCategoryLink($catid, $category.link_rewrite)|escape:'htmlall':'UTF-8'}" class="topcatname">
								{$current_category.name|escape:'htmlall':'UTF-8'|truncate:50:'...'}
							</a>
						</span>
					</li>
				{/foreach}
			</ul>
		{/if}
</div>	