<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// | Simplified Chinese version   http://www.zen-cart.cn                  |
// +----------------------------------------------------------------------+
//  $Id: salemaker_info.php 290 2004-09-15 19:48:26Z wilt $
//

define('HEADING_TITLE', '促销管理');
define('SUBHEADING_TITLE', '促销管理指南:');
define('INFO_TEXT', '<ul>
                      <li>
                        减价和标价时请使用 \'.\' 作为小数点。
                      </li>
                      <li>
                        采用与创建、编辑商品时相同货币的金额。
                      </li>
                      <li>
                        减价字段，可以输入金额、百分比、
                        或新的价格. (例如：从所有价格中减5元、
                        从所有价格中减10%或修改所有价格为25元)
                      </li>
                      <li>
                        可以输入一个价格区间以减少应用的商品范围。(例如：
                        从50元到150元的商品)
                      </li>
                      <li>
                        当商品有特价<b>且</b>促销时，您必须作出选择:
						<ul>
                          <li>
                            <strong>忽略特价 - 促销价以商品原价为基础且取代特价</strong><br>
							该促销将替代商品原价。
                            (例如：原价10元，特价9.5元，促销10%，
							该商品的最后价格为9元，忽略特价信息)
                          </li>
                          <li>
                            <strong>忽略促销 - 当商品有特价时，不允许促销</strong><br>
                            特价商品不进行促销，该特价商品将不显示促销价。 
                            (例如：原价10元，特价9.5元，促销10%，
							该商品的最后价格为9.5元，忽略促销信息)
                          </li>
                          <li>
                            <strong>在特价基础上促销 - 否则在原价基础上促销</strong><br>
                            允许在特价基础上促销，将显示综合的价格。
                            (例如：原价10元，特价9.5元，促销10%，
							该商品的最后价格为8.55元，是在特价的基础上优惠10%。)
                          </li>
                        </ul>
                      </li>
                      <li>
                        如果生效日为空，表示促销立刻生效。
                      </li>
                      <li>
                        如果到期日为空，表示促销永久有效。</li>
                      <li>
                        检查分类时自动检查子分类。
                      </li>
                    </ul>');
define('TEXT_CLOSE_WINDOW', '[关闭窗口]');
?>