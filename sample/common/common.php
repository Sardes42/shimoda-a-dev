<?php

function gengo($seireki)
{
	if(1868<=$seireki && $seireki<=1911)
	{
		$gengo='明治';
	}

	if(1912<=$seireki && $seireki<=1925)
	{
		$gengo='大正';
	}

	if(1926<=$seireki && $seireki<=1988)
	{
		$gengo='昭和';
	}

	if(1989<=$seireki)
	{
		$gengo='平成';
	}

	return($gengo);
}

function sanitize($before)
{
	foreach($before as $key=>$value)
	{
		$after[$key]=htmlspecialchars($value);
	}
	return $after;
}

function pulldown_year()
{
	print '<select name="year">';
	print '<option value="2013">2013</option>';
	print '<option value="2014">2014</option>';
	print '<option value="2015">2015</option>';
	print '<option value="2016">2016</option>';
	print '<option value="2017">2017</option>';
	print '</select>';
}

function pulldown_month()
{
	print '<select name="month">';
	print '<option value="01">01</option>';
	print '<option value="02">02</option>';
	print '<option value="03">03</option>';
	print '<option value="04">04</option>';
	print '<option value="05">05</option>';
	print '<option value="06">06</option>';
	print '<option value="07">07</option>';
	print '<option value="08">08</option>';
	print '<option value="09">09</option>';
	print '<option value="10">10</option>';
	print '<option value="11">11</option>';
	print '<option value="12">12</option>';
	print '</select>';
}

function pulldown_day()
{
	print '<select name="day">';
	print '<option value="01">01</option>';
	print '<option value="02">02</option>';
	print '<option value="03">03</option>';
	print '<option value="04">04</option>';
	print '<option value="05">05</option>';
	print '<option value="06">06</option>';
	print '<option value="07">07</option>';
	print '<option value="08">08</option>';
	print '<option value="09">09</option>';
	print '<option value="10">10</option>';
	print '<option value="11">11</option>';
	print '<option value="12">12</option>';
	print '<option value="13">13</option>';
	print '<option value="14">14</option>';
	print '<option value="15">15</option>';
	print '<option value="16">16</option>';
	print '<option value="17">17</option>';
	print '<option value="18">18</option>';
	print '<option value="19">19</option>';
	print '<option value="20">20</option>';
	print '<option value="21">21</option>';
	print '<option value="22">22</option>';
	print '<option value="23">23</option>';
	print '<option value="24">24</option>';
	print '<option value="25">25</option>';
	print '<option value="26">26</option>';
	print '<option value="27">27</option>';
	print '<option value="28">28</option>';
	print '<option value="29">29</option>';
	print '<option value="30">30</option>';
	print '<option value="31">31</option>';
	print '</select>';
}

function h($var)
{
 if(is_array($var))
 {
  return array_map('h',$var);
 }
 else
 {
  return htmlspecialchars($var,ENT_QUOTES,'UTF-8');
 }
} 

function pulldown_santi()
{
	print '<select name="santi">';
	print '<option value=" "></option>';
	print '<option value=" 秋田">秋田</option>';
	print '<option value=" 新潟">新潟</option>';
	print '<option value=" 青森">青森</option>';
	print '<option value=" 山形">山形</option>';
	print '<option value=" 北海道">北海道</option>';
	print '</select>';
}

function pulldown_meigara()
{
	print '<select name="meigara">';
	print '<option value=" "></option>';
	print '<option value=" あきたこまち">あきたこまち</option>';
	print '<option value=" コシヒカリ">コシヒカリ</option>';
	print '<option value=" 晴天の霹靂">晴天の霹靂</option>';
	print '<option value=" つや姫">つや姫</option>';
	print '<option value=" ななつぼし">ななつぼし</option>';
	print '</select>';
}
function pulldown_nedan()
{
	print '<select name="nedan">';
	print '<option value=" "></option>';
	print '<option value=" 小">小</option>';
	print '<option value=" 中">中</option>';
	print '<option value=" 高">高</option>';
	print '</select>';
}

?>