INSERT INTO articles VALUES 
(1,'业内动态第一篇','YNDT','<p>不知道有什么动态</p>

<p><img alt="" src="http://localhost/bgwrealty/app/webroot/img/upload/Idea.jpg" style="height:226px; width:300px" /></p>
','2016-03-01 15:37:04',0,0,'APPROVAL','复制.jpg',0),
(2,'市政规划第一篇','SZGH','<table border="0" cellpadding="1" cellspacing="1" style="width:500px">
	<tbody>
		<tr>
			<td><img alt="" src="http://localhost/bgwrealty/app/webroot/img/upload/Wifi.jpg" style="height:207px; width:244px" /></td>
			<td>
			<table border="0" cellpadding="1" cellspacing="1" style="width:500px">
				<tbody>
					<tr>
						<td>Kensington 区要有free WiFi了~~~</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>以后上网不用花钱了~~~</td>
					</tr>
				</tbody>
			</table>

			<p>&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td>哈哈哈哈</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>
','2016-03-01 16:16:35',3,0,'APPROVAL','FileZilla_3.14.1_macosx-x86.app.tar.bz2',0),
(3,'业内动态第二篇','YNDT','<p><img alt="" src="http://localhost/bgwrealty/app/webroot/img/upload/Idea.jpg" style="height:226px; width:300px" /></p>

<p>没啥内容，随便写点啥</p>
','2016-03-02 02:41:55',2,0,'APPROVAL',NULL,0),
(4,'市场数据第一篇','SCSJ','<p><img alt="" src="http://localhost/bgwrealty/app/webroot/img/upload/Wifi.jpg" style="height:207px; width:244px" /></p>

<p>谁知道呢</p>
','2016-03-02 13:10:46',3,2,'APPROVAL','Idea.jpg',0),
(5,'政策信息第一篇','ZCXX','<p>不知道</p>
','2016-03-02 13:13:50',2,1,'APPROVAL','Idea.jpg',0),
(6,'楼盘信息第一篇','LPXX','<p><img alt="" src="http://localhost/bgwrealty/app/webroot/img/upload/20150725_135004.jpg" style="height:183px; width:326px" /></p>

<p>这个楼盘要涨价~~~！</p>
','2016-03-05 14:57:57',3,2,'DRAFT',NULL,1),
(9,'茜','SJFXN',NULL,'2016-03-14 14:13:06',2,0,'DRAFT',NULL,1),
(10,'业内动态第4篇','YNDT','<p>不知道有什么动态</p>

<p><img alt="" src="http://localhost/bgwrealty/app/webroot/img/upload/Idea.jpg" style="height:226px; width:300px" /></p>
','2016-03-01 15:37:04',0,0,'APPROVAL','复制.jpg',1);

INSERT INTO contacts VALUES 
(1,'2016-03-06','2016-03-06 14:01:43','打了一次电话吧',0,1,1,NULL,NULL,NULL,NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL),
(3,'2016-02-11','2016-02-16 14:24:33','很早的联系',0,1,1,NULL,NULL,NULL,NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL),
(4,'2016-03-05','2016-03-06 14:42:04','谈了几分钟',0,3,1,NULL,NULL,NULL,NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL),
(5,'2016-03-06','2016-03-08 04:42:44','11111',0,1,1,'12','2','3','4',1,1,'5','6',1,'7','8','9999','0000'),
(6,'2016-03-07','2016-03-13 01:25:47','werq35',0,2,4,'3135','w5a','ijoj','明天',2,1,'adf ','asd a',1,'asdfa','fasdf','asdf','asdf'),
(7,'2016-03-09','2016-03-13 01:27:07',NULL,0,5,4,NULL,NULL,NULL,NULL,2,2,NULL,NULL,0,NULL,NULL,NULL,NULL),
(8,'2016-03-06','2016-03-06 14:01:43','打了一次电话吧',0,1,1,NULL,NULL,NULL,NULL,0,0,NULL,NULL,0,NULL,NULL,NULL,NULL);

INSERT INTO ctypes VALUES 
(1,'KHFL','很热'),
(3,'KHLY','朋友介绍'),
(4,'KHLY','网站广告');

INSERT INTO ctypes_customers VALUES 
(3,1),
(1,2),
(3,2),
(1,3),
(3,3),
(4,3),
(1,4),
(4,4);

INSERT INTO customers VALUES 
(1,'客户1',1,'2016-02-29 19:29:19',4,1,'1313515',NULL,'customer@cs.com',NULL,'投资','物业2<br/>','Kingsford<br/>','两室一厅一卫<br/>三室一厅一卫<br/>',NULL,'朋友介绍<br/>',300,1000),
(2,'客户2',0,'2016-02-29 19:55:31',0,4,'1352326',NULL,'customer@cs.com',NULL,'自住','物业2<br/>','Kingsford<br/>Kensington<br/>','三室一厅一卫<br/>','很热<br/>','朋友介绍<br/>',500,1300),
(3,'客户3',1,'2016-02-29 20:06:16',0,1,'13532346',NULL,'customer@cs.com',NULL,NULL,'物业2<br/>','Kingsford<br/>','两室一厅一卫<br/>三室一厅一卫<br/>','分类3<br/>','朋友介绍<br/>网站广告<br/>',500,1400),
(4,'客户11',0,'2016-03-12 15:58:29',0,3,NULL,NULL,NULL,NULL,'投资','物业1<br/>','Kensington<br/>','两室一厅一卫<br/>','很热<br/>','网站广告<br/>',0,0),
(5,'客户12',0,'2016-03-12 15:59:12',0,4,NULL,NULL,NULL,NULL,'自住','物业1<br/>','Kensington<br/>','三室一厅一卫<br/>',NULL,'网站广告<br/>',0,0);

INSERT INTO customers_ptypes VALUES 
(1,1),
(3,1),
(4,1),
(1,2),
(2,2),
(3,2),
(5,2);

INSERT INTO customers_suburbs VALUES 
(1,2),
(2,2),
(3,2),
(2,3),
(4,3),
(5,3);

INSERT INTO customers_wys VALUES 
(4,1),
(5,1),
(1,2),
(2,2),
(3,2);

INSERT INTO deals VALUES 
(1,'2016-03-10 03:21:58',1,1,NULL,'$11','$11','$11','11',NULL,'投资','PR/Citizen','11','11','11','11','11','11','11','11','1','2016-03-05','2016-03-10 15:03:39','2016-03-04','2016-03-06','$1111','1213','Idea.jpg','2016-03-11 01:46:41','2016-03-01','复制.jpg',NULL,'2016-03-11 01:51:47','2016-03-07','55','55','53','353','35353353','lnln','lnlnlnl','2016-03-11 01:52:14','2016-03-07','1rr1r','12411','2016-03-11 01:52:24','2016-03-08','13r1','141','2016-03-11 01:53:43','11','15135','2525','werq','2016-03-07','2016-03-06','2016-03-06','$235235','1245235','CZ',1),
(2,'2016-03-10 03:29:14',3,2,NULL,'$22','$22','$2','2',NULL,'自住','PR/Citizen','2','22','2','2','11','11','11','11','1','2016-03-04',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'C',1);

INSERT INTO employees VALUES 
(1,'员工1',1,'2016-02-28 14:14:15','1942-05-07','123','aa@aa.com',NULL,1,1,2),
(2,'bb',0,'2016-02-28 14:16:07','1943-10-12','1214134','adfa@agag.com',NULL,0,0,0),
(3,'员工2',0,'2016-02-28 14:23:43','1991-10-19','1214134',NULL,NULL,1,7,3),
(4,'员工3',1,'2016-02-28 16:26:54','1947-09-17','12435326','aa@aa.com',NULL,0,8,2),
(5,'emp11',1,'2016-03-12 15:56:53','1938-04-05','1314','1515','31gsgw',0,0,2);

INSERT INTO feedbacks VALUES 
(1,'很好','很好','很好','nothing',1);

INSERT INTO guidances VALUES 
(1,'hh工',2,4);

INSERT INTO lawyers VALUES 
;

INSERT INTO pages VALUES 
(1,'about','<table border="0" cellpadding="1" cellspacing="1" style="width:950px">
	<tbody>
		<tr>
			<td><img alt="" src="http://localhost/bgwrealty/app/webroot/img/upload/Idea.jpg" style="height:301px; width:400px" /></td>
			<td>
			<p>公司名称：BGW Realty Pty. Ltd. &nbsp;澳洲创富地产有限公司</p>

			<p>&nbsp;</p>

			<p>经营范围：房屋买卖、房屋租赁、购地建屋、项目开发、投资融资</p>

			<p>&nbsp;</p>

			<p>服务宗旨：诚信服务，为您创富！</p>

			<p>&nbsp;</p>

			<p>公司地址：Suite 602，Level 6，5 Hunter Street Sydney NSW 2000</p>

			<p>&nbsp;</p>

			<p>联系电话：+61 2 8541 4108 &nbsp; +61 42108 4881</p>

			<p>&nbsp;</p>

			<p>电子邮件：<a href="mailto:david@bgwrealty.com.au">david@bgwrealty.com.au</a></p>
			</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>
'),
(2,'info',NULL),
(3,'contact',NULL),
(4,'join','<p>澳洲创富地产公司欢迎您的加入！</p>

<p>诚信服务，为您创富！</p>

<p>请发送简历到：<a href="mailto:david@bgwrealty.com.au">david@bgwrealty.com.au</a>&nbsp;或 电话联系：David 0421084881</p>
'),
(5,'电话','+61 2 8541 4108   
+61 4 2108 4881'),
(6,'E-mail','info@bgwrealty.com.au'),
(7,'地址','Suite 602, Level 6, 5 Hunter Street Sydney NSW 2000'),
(8,'新客户注册','<p>欢迎加入BGW Realty - 创富地产.</p>

<p>&nbsp;</p>

<p>您的用户名为: $USERNAME</p>

<p>初始密码为: $PASSWORD</p>

<p>&nbsp;</p>

<p>请尽快修改密码. 谢谢合作!</p>
'),
(9,'客户重置密码','<p>欢迎加入BGW Realty - 创富地产.</p>

<p>&nbsp;</p>

<p>您的用户名为: $USERNAME</p>

<p>密码已重置为初始密码: $PASSWORD</p>

<p>&nbsp;</p>

<p>请尽快修改密码. 谢谢合作!</p>
'),
(10,'新员工注册','<p>欢迎加入BGW Realty - 创富地产.</p>

<p>&nbsp;</p>

<p>您的用户名为: $USERNAME</p>

<p>初始密码为: $PASSWORD</p>

<p>&nbsp;</p>

<p>请尽快修改密码. 谢谢合作!</p>
'),
(11,'员工重置密码','<p>欢迎加入BGW Realty - 创富地产.</p>

<p>&nbsp;</p>

<p>您的用户名为: $USERNAME</p>

<p>密码已重置为初始密码: $PASSWORD</p>

<p>&nbsp;</p>

<p>请尽快修改密码. 谢谢合作!</p>
');

INSERT INTO plans VALUES 
(1,'第一个月业务计划','YW-M','2016-03-06 15:20:13','没啥计划~·',1),
(2,'第一个年业务计划','YW-Y','2016-03-06 15:20:36','计划一下',1);

INSERT INTO properties VALUES 
(1,'楼盘1号','i dont know',300,800,'<table border="0" cellpadding="1" cellspacing="1" style="width:500px">
	<tbody>
		<tr>
			<td><img alt="" src="http://localhost/bgwrealty/app/webroot/img/upload/Idea.jpg" style="height:225px; width:300px" /></td>
			<td>
			<p>暴走鞋a</p>

			<p>莾</p>

			<p>艺术硕士adfa</p>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
			<p>工</p>

			<p>工</p>

			<p>&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
			<p>工</p>

			<p>&nbsp;a</p>
			</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>
',0,2),
(2,'楼盘2号','i know',500,1100,'<p>a</p>

<p>a</p>

<p>bfa&nbsp;</p>

<table border="0" cellpadding="1" cellspacing="1" style="width:500px">
	<tbody>
		<tr>
			<td><img alt="" src="http://localhost/bgwrealty/app/webroot/img/upload/Wifi.jpg" style="height:207px; width:244px" /></td>
			<td>
			<table border="0" cellpadding="1" cellspacing="1" style="width:500px">
				<tbody>
					<tr>
						<td>fafa</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>adfadf</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;asdf a</td>
					</tr>
				</tbody>
			</table>

			<p>&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>sdfadsf</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>sadfadf</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>
',0,3),
(8,'楼盘3','没有',300,1200,'<p>这个楼盘好</p>
',0,2);

INSERT INTO properties_ptypes VALUES 
(1,1),
(8,1),
(1,2),
(2,2),
(8,2);

INSERT INTO ptypes VALUES 
(1,'两室一厅一卫'),
(2,'三室一厅一卫');

INSERT INTO suburbs VALUES 
(2,'Kingsford'),
(3,'Kensington');

INSERT INTO summaries VALUES 
(1,'月业务总结第一篇','YW-M','2016-03-06 15:48:44','没有~',1);

INSERT INTO teams VALUES 
(2,'团队2',2),
(3,'团队3',1);

INSERT INTO users VALUES 
(1,'shawnm0705@gmail.com','$2a$10$iJkPIJ/DuOfoj7DdxSXMiOq1MrCYLbIQIsKKCfV5SwoPlnI8OjAFq','71','leader',1,1),
(3,'admin','$2a$10$b6ca.2lgJIJcicu4uuJJ/.Z7pnY3Y5Kl8RLisi6cL8C0bWKzey/qS','admin','admin',1,0),
(4,'no1@customer.com','$2a$10$Wx/i0S23KjRe9COra3DkduyMfdqacCEgwd4q1NfLGT6hhd4NQ5jQe','5dd2b7ba','customer',1,1),
(7,'yg2@bgwrealty.com.au','$2a$10$2hXwDos5oIsSWNf5PWwDhubeM2ApOU6AVKGjVtmzLOLOoqvVFnJxe','16df7c1b','leader',1,3),
(8,'em3@em.com','$2a$10$s7rWsk1xzUyU2simrBL.vO56PutuVVPkhaQ6p5kXQvEBGnn4ChEnW','4825e20a','employee',1,4);

INSERT INTO wys VALUES 
(1,'物业1','1213214','wy@wy.com','yes','nothing'),
(2,'物业2','133525','wy@wy.com',NULL,'yes
');

