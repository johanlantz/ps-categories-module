
	<!--{l s='Available categories' mod='givensacategories'}-->

<div>		
		<div class="catcol catid{$catid}">
				<a href="{$link->getCategoryLink($my_id_category_current, $category.link_rewrite)|escape:'htmlall':'UTF-8'}" class="topcatname">
					{l s='All Products' mod='givensacategories'}
				</a>
		</div>	
		{foreach $mySubCategories as $current_category}
			{$catid=$current_category.id_category}
			<div class="catcol catid{$catid}">
				<a href="{$link->getCategoryLink($catid, $category.link_rewrite)|escape:'htmlall':'UTF-8'}" class="topcatname">
					{$current_category.name|escape:'htmlall':'UTF-8'|truncate:50:'...'}
				</a>
			</div>
		{/foreach}
</div>	