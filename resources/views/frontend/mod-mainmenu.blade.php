<style>
.menu-wrapper,
.menu a {
    width: 100%;
}

.menu::after {
    content: '';
    clear: both;
    display: block;
}

.menu a {
    display: block;
    padding: 10px;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    text-decoration: none;
    font-size: 20px;
}

.menu li {
    position: relative;
}

.menu>li {
    float: left;
}

.menu,
.menu ul {
    display: inline-block;
    padding: 0;
    margin: 0;
    list-style-type: none;
    background: white;
}

.menu ul li+li {
    border-top: 1px solid #fff;
}

.menu ul {
    position: absolute;
    box-shadow: 5px 5px 10px 0 rgba(0, 0, 0, 0.5);
}

.menu>li ul,
.menu ul ul {
    opacity: 0;
    -webkit-transition: all 0.2s ease-in;
    -moz-transition: all 0.2s ease-in;
    transition: all 0.2s ease-in;
    z-index: -1;
    visibility: hidden;
}

.menu>li ul {
    top: 130%;
    left: 0;
}

.menu ul ul {
    left: 130%;
    top: 0;
}

.menu ul a {
    width: 250px;
}

.menu>li:hover>ul {
    top: 100%;
    opacity: 1;
    z-index: 1;
    visibility: visible;
}

.menu ul>li:hover>ul {
    left: 100%;
    opacity: 1;
    z-index: 1;
    visibility: visible;
}

.menu-gold,
.menu-gold a {
    background-color: orange;
    color: #000;
}

.menu-gold a:hover {
    background-color: orange;
    color: black;
    border-bottom: 1px solid orange;
}
</style>
<?php 
use App\Models\Menu;
$arg_mainmenu1=[['parent_id','=',0],
['status','=',1],
['position','=','mainmenu']];
$list_menu=Menu::where($arg_mainmenu1)->orderBy('sort_order','asc')->get();
?>
<div class="container">
    <div class="menu-wrapper  menu-gold">
        <ul class="menu">
            <?php foreach($list_menu as $row_menu): ?>
            <?php $arg_mainmenu2=[['parent_id','=',$row_menu->id],
                                        ['status','=',1],
                                        ['position','=','mainmenu']];
                        $list_menu1=Menu::where($arg_mainmenu2)->orderBy('sort_order','asc')->get();
                    if(count($list_menu1)!=0):?>
            <li>
                <a href="{{ route('slug.index', ['slug' => $row_menu->link]) }}"> <?=$row_menu->name ?></a>
                <ul>
                    <?php foreach($list_menu1 as $row_menu1): ?>
                    <?php $arg_mainmenu3=[['parent_id','=',$row_menu1->id],
                                        ['status','=',1],
                                        ['position','=','mainmenu']];
                        $list_menu2=Menu::where($arg_mainmenu3)->orderBy('sort_order','asc')->get();
                    if(count($list_menu2)!=0):?>
                    <li><a href="{{ route('slug.index', ['slug' => $row_menu->link]) }}"> <?=$row_menu1->name ?></a>
                        <ul>
                            <?php foreach($list_menu2 as $row_menu2): ?>
                            <li>
                                <a href="{{ route('slug.index', ['slug' => $row_menu2->link]) }}"> <?=$row_menu2->name ?></a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li>
                        <a href="{{ route('slug.index', ['slug' => $row_menu->link]) }}"> <?=$row_menu1->name ?></a>
                    </li>
                    <?php endif; ?>
                    <?php endforeach;?>
                </ul>
            </li>
            <?php else: ?>
            <li>
                <a href="{{ route('slug.index', ['slug' => $row_menu->link]) }}"> <?=$row_menu->name ?></a>
            </li>
            <?php endif; ?>
            <?php endforeach;?>
        </ul>
    </div>
</div>