<?php

class Pagination 
{
	//huidige pagina
	var $page;
	//maximum aantal records
	var $size;
	//totaal aantal records
	var $total_records;
	//link voor de navigatie
	var $link;
	
	//class constructie
	function Pagination($page = null, $size = null, $total_records = null)
	{
		$this->page = $page;
		$this->size = $size;
		$this->total_records = $total_records;
	}
	
	//zet huidige pagina
	function setPage($page)
	{
		$this->page = 0+$page;
	}
	
	//zet records per pagina
	function setSize($size)
	{
		$this->size = 0+$size;
	}
		
	//zet totaal aantal records
	function setTotalRecords($total)
	{
		$this->total_records = 0+$total;
	}
	
	//zet de url in link
	function setLink($url)
	{
		$this->link = $url;
	}
	
	//stuur terug de limiet van de sql query
	function getLimitSql()
	{
		$sql = "LIMIT " . $this->getLimit();
		return $sql;
	}
		
	/**
	 * Get the LIMIT statment
	 *
	 * @return string
	 */
	function getLimit()
	{
		if ($this->total_records == 0)
		{
			$lastpage = 0;
		}
		else 
		{
			$lastpage = ceil($this->total_records/$this->size);
		}
		
		$page = $this->page;		
		
		if ($this->page < 1)
		{
			$page = 1;
		} 
		else if ($this->page > $lastpage && $lastpage > 0)
		{
			$page = $lastpage;
		}
		else 
		{
			$page = $this->page;
		}
		
		$sql = ($page - 1) * $this->size . "," . $this->size;
		
		return $sql;
	}
	
	//maak de paginatie aan met al de links
	function create_links()
	{
		$totalItems = $this->total_records;
		$perPage = $this->size;
		$currentPage = $this->page;
		$link = $this->link;
		$totalPages = floor($totalItems / $perPage);
		$totalPages += ($totalItems % $perPage != 0) ? 1 : 0;

		if ($totalPages < 1 || $totalPages == 1){
			return null;
		}

		$output = null;				
		$loopStart = 1; 
		$loopEnd = $totalPages;

		if ($totalPages > 5)
		{
			if ($currentPage <= 3)
			{
				$loopStart = 1;
				$loopEnd = 5;
			}
			else if ($currentPage >= $totalPages - 2)
			{
				$loopStart = $totalPages - 4;
				$loopEnd = $totalPages;
			}
			else
			{
				$loopStart = $currentPage - 2;
				$loopEnd = $currentPage + 2;
			}
		}

		if ($loopStart != 1){
			$output .= sprintf('<li class="disabledpage"> <a href="' . $link . '">&#171;</a> </li>', '1');
		}
		
		if ($currentPage > 1){
			$output .= sprintf('<li class="nextpage"> <a href="' . $link . '">'._previous_.'</a> </li>', $currentPage - 1);
		}
		
		for ($i = $loopStart; $i <= $loopEnd; $i++)
		{
			if ($i == $currentPage){
				$output .= '<li class="currentpage">' . $i . '</li> ';
			} else {
				$output .= sprintf('<li><a href="' . $link . '">', $i) . $i . '</a> </li> ';
			}
		}

		if ($currentPage < $totalPages){
			$output .= sprintf('<li class="nextpage"> <a href="' . $link . '">'._next_.'</a> </li>', $currentPage + 1);
		}
		
		if ($loopEnd != $totalPages){
			$output .= sprintf('<li class="nextpage"> <a href="' . $link . '">&#187;</a> </li>', $totalPages);
		}

		return '<div class="pagination"><ul>' . $output . '</ul></div>';
	}
}

?>