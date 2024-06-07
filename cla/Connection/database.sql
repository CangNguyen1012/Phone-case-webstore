create database gcs1001b;

use gcs1001b;

create table category
(
categoryID varchar(3) not null primary key,
`name` varchar(20) not null unique,
note varchar(100) null
);

create table product
(
productID varchar(5) not null primary key,
`name` varchar(30) not null,
price int not null,
image varchar(20) null,
detail varchar(30) null,
categoryID varchar(3) not null,
constraint fk_cat foreign key (categoryID)
references category(categoryID)
);

create table customer
(
customerID varchar(5) not null primary key,
`password` varchar(20) not null,
fullname varchar(50) not null,
address varchar(30) null,
email varchar(20) null,
phone varchar(10) null
);

create table `admin`
(
adminID varchar(10) not null primary key,
`password` varchar(20) not null,
fullname varchar(30) not null,
email varchar(20) not null
);

/* add data */
select * from category;
insert into category (categoryID,`name`) values
('C01','APPLE'), ('C02','SAMSUNG'),('C03','LG'),('C04','HTC'),
('C05','SONY'),('C06','MOTOROLA');


insert into product values
('P001','CASE 01',5,'produc01.jpg','no','C02'),
('P002','CASE 02',6,'produc02.jpg','no','C03'),
('P003','CASE 03',7,'produc03.jpg','no','C01'),
('P004','CASE 04',2,'produc04.jpg','no','C01'),
('P005','CASE 05',3,'produc05.jpg','no','C02'),
('P006','CASE 06',7,'produc06.jpg','no','C01'),
('P007','CASE 07',1,'produc07.jpg','no','C06'),
('P008','CASE 08',8,'produc08.jpg','no','C04'),
('P009','CASE 09',8,'produc09.jpg','no','C05'),
('P010','CASE 10',9,'produc10.jpg','no','C01'),
('P011','CASE 11',3,'produc11.jpg','no','C03'),
('P012','CASE 12',4,'produc12.jpg','no','C06'),
('P013','CASE 13',3,'produc13.jpg','no','C05'),
('P014','CASE 14',5,'produc14.jpg','no','C01'),
('P015','CASE 15',5,'produc15.jpg','no','C01');

insert into customer values
('c001','123456','Ngoc Trinh','HCM','ngoctrinh@gmail.com','0915486745'),
('c002','111111','Son Tung','HCM','sontung@gmail.com','0987621123');

insert into `admin` values
('ad001','987654','Lu Gia Thanh','thanhlg@gmail.com','0906123456'),
('ad002','456123','Giang Trieu Phat','phatgt@gmail.com','0932164857');