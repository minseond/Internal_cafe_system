 #Order(order_num, price, order_time, count)
 #Employee(E_id, title, e_name, phone_number, password, #order_num)
 
 CREATE DATABASE company_internal_cafe;
 
 use company_internal_cafe;
 
 CREATE TABLE EMPLOYEE(
	e_id int NOT NULL AUTO_INCREMENT,
    title varchar(45) NOT NULL,
    e_name varchar(45) NOT NULL,
    phone_number varchar(45),
    password varchar(45) NOT NULL,
    img longblob,
    CONSTRAINT PK_employee PRIMARY KEY (e_id)
 );
 
 CREATE TABLE CAFE(
	cafe_id int NOT NULL AUTO_INCREMENT,
    cafe_name varchar(45), 
    phone_number varchar(45),
    operatingHours varchar(45),
    city varchar(45),
    ku varchar(45),
    dong varchar(45),
    zipcode varchar(45),
    CONSTRAINT PK_cafe PRIMARY KEY (cafe_id)
);
    
 CREATE TABLE ORDER2(
	order_num int NOT NULL AUTO_INCREMENT,
    total_amount varchar(45) NOT NULL,
    order_date date,
    e_id int NOT NULL,
    CONSTRAINT PK_order PRIMARY KEY (order_num)
 );
 
ALTER TABLE ORDER2
ADD CONSTRAINT FK_ORDER_EMPLOYEE 
FOREIGN KEY (e_id) REFERENCES EMPLOYEE(e_id);

#DROP TABLE MILEAGE;

CREATE TABLE MILEAGE(
	m_id int NOT NULL AUTO_INCREMENT, 
    order_num int NOT NULL,
	e_id int NOT NULL,
    useTimestamp date,
    current_amount varchar(45),
    amount varchar(45),
    final_amount varchar(45),
    CONSTRAINT PK_mileage PRIMARY KEY (m_id, e_id, order_num)
);

ALTER TABLE MILEAGE
ADD CONSTRAINT FK_mileage_employee 
FOREIGN KEY (e_id) REFERENCES EMPLOYEE(e_id);

ALTER TABLE MILEAGE
ADD CONSTRAINT FK_mileage_order
FOREIGN KEY (order_num) REFERENCES ORDER2(ORDER_NUM);

CREATE TABLE MENU2(
	menu_id int NOT NULL AUTO_INCREMENT,
    menu_price varchar(45) NOT NULL,
    menu_name varchar(45) NOT NULL,
    menu_img longblob,
    menu_detail varchar(120) NOT NULL,
    menu_tag varchar(45) NOT NULL,
    CONSTRAINT PK_menu PRIMARY KEY (menu_id)
);

#ALTER TABLE MENU DROP COLUMN b_id;

CREATE TABLE SATISFACTION(
	satis_id int NOT NULL AUTO_INCREMENT,
    date date,
    order_num int NOT NULL,
    e_id int NOT NULL,
    CONSTRAINT PK_SAT PRIMARY KEY (satis_id),
    CONSTRAINT FK_SAT_ORDER 
    FOREIGN KEY (order_num) REFERENCES ORDER2(order_num),
    CONSTRAINT FK_SAT_EMPLOYEE
    FOREIGN KEY (e_id) REFERENCES EMPLOYEE(e_id)
);

CREATE TABLE INCLUDES(
	order_num int NOT NULL,
    menu_id int NOT NULL,
    quantity int NOT NULL,
    CONSTRAINT PK_INCLUD PRIMARY KEY (order_num, menu_id)
);

ALTER TABLE INCLUDES
ADD CONSTRAINT FK_INCLUD_ORDERS 
FOREIGN KEY (order_num) REFERENCES ORDER2(order_num);

ALTER TABLE INCLUDES
ADD CONSTRAINT FK_INCLUD_MENU
FOREIGN KEY (menu_id) REFERENCES MENU2(menu_id);

CREATE TABLE COMM(
	satis_id int NOT NULL,
    comment varchar(45),
    CONSTRAINT PK_comm PRIMARY KEY (comment, satis_id)
);

ALTER TABLE COMM
ADD CONSTRAINT FK_COMM_SATIS 
FOREIGN KEY (satis_id) REFERENCES SATISFACTION(satis_id);

#view
CREATE VIEW order_details_view AS
SELECT o.order_num AS order_num, o.total_amount AS total_amount, o.order_date AS order_date, m.menu_id AS menu_id, m.menu_name AS menu_name, m.menu_price AS menu_price, i.quantity AS quantity
FROM order2 o
JOIN includes i ON o.order_num = i.order_num
JOIN menu2 m ON i.menu_id = m.menu_id;