<?php
include 'connectToMySql.php';

function deleteTable()
{
    $cnn = OpenConn();
    $sql = "DELETE FROM districts";
    $sql2 = "DELETE FROM streets";
    $cnn->query($sql);
    $cnn->query($sql2);
    CloseConn($cnn);
}

function createTABLE()
{
    $cnn = OpenConn();
    $sql = "CREATE TABLE IF NOT EXISTS districts (
    id int NOT NULL AUTO_INCREMENT, 
    name varchar(255),
    PRIMARY KEY (id))";

    $sql2 = "CREATE TABLE IF NOT EXISTS streets (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    district varchar(255),
    founding date,
    description text,
    status varchar(255),
    PRIMARY KEY (id))";

    $cnn->query($sql);
    $cnn->query($sql2);

    CloseConn($cnn);
}

function seeder()
{
    $cnn = OpenConn();
    $sql = "INSERT INTO districts (name) VALUES ('Đống Đa'), ('Ba Đình'), ('Thanh Xuân'), ('Cầu Giấy'), ('Hà Đông')";

    $sql2 = "INSERT INTO streets (name, district, founding, description, status) VALUES 
            ('Nguyễn Thái Học', 'Hà Đông', '2008-12-19', 'Đường Nguyễn Thái Học thuộc địa phận 2 phường Quang Trung và Yết Kiêu quận Hà Đông - Hà Nội, khởi đầu từ đường Quang Trung (số nhà 16 Quang Trung), chạy qua các đường Phan Đình Phùng, Trương Công Định tới đoạn nối với đường Phan Huy Chú.
Đường dài khoảng 300m, rộng 8m.', 'Being Used'),
            ('Vạn Phúc', 'Ba Đình', '2007-06-05', 'Phố Vạn Phúc thuộc địa phận các phường Liễu Giai, Ngọc Khánh, Kim Mã quận Ba Đình, Hà Nội. phố Vạn Phúc khởi đầu từ đường Liễu Giai, chạy dài cắt qua đường Vạn Bảo và kết thúc khi giao nhau với ngõ 218 đường Đội Cấn, phố có chiều dài khoảng 650m.', 'Being Used'),
            ('Tây Sơn', 'Đống Đa', '2007-12-12', 'Phố Tây Sơn là một con phố thuộc các phường Quang Trung, Trung Liệt và Ngã Tư Sở, quận Đống Đa, thành phố Hà Nội. Phố dài 1330m, bắt đầu từ phố Nguyễn Lương Bằng đến Ngã Tư Sở, nối tiếp đường Nguyễn Trãi.', 'Being Used'),
            ('Nguyễn Thái Học', 'Đống Đa', '2006-11-07', 'Phố Nguyễn Thái Học (tên cũ: phố Hàng Đẫy, đường số 59, đại lộ Borgnis Desbordes kéo dài, phố Duvillier, phố Phan Chu Trinh) là một phố nằm trên địa bàn phường Cát Linh và phường Văn Miếu, quận Đống Đa; phường Điện Biên và phường Kim Mã, quận Ba Đình - Hà Nội và phường Cửa Nam - Quận Hoàn Kiếm.', 'Being Used'),
            ('Hoàng Quốc Việt', 'Cầu Giấy', '2008-01-07', 'Đường Hoàng Quốc Việt thuộc địa phận các phường Cổ Nhuế 1 quận Bắc Từ Liêm, Nghĩa Tân, Nghĩa Đô quận Cầu Giấy, Hà Nội. đường Hoàng Quốc Việt khởi đầu từ đường Phạm Văn Đồng, chạy dài giao với các đường Trần Cung, Nguyễn Phong Sắc và kết thúc trên đường Bưởi đoạn giao với đường Võ Chí Công, đường có chiều dài khoảng 2, 5km.', 'Being Used')";

    $cnn->query($sql);
    $cnn->query($sql2);

    CloseConn($cnn);
}

deleteTable();
createTABLE();
seeder();
header('Location: ../form.php');