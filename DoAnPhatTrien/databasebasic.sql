CREATE DATABASE Yugioh2;

USE Yugioh2;

CREATE TABLE Roles (
    RoleID INT PRIMARY KEY AUTO_INCREMENT,
    RoleName VARCHAR(50)
);

CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50),
    Password VARCHAR(100),
    Email VARCHAR(100),
    NgayTao DATETIME,
    IDRole INT,
    level INT,
    Rank VARCHAR(10),
    SoDu INT,
    Win INT,
    imageus TEXT,
    FOREIGN KEY (IDRole) REFERENCES Roles(RoleID)
);

CREATE TABLE ItemCategories (
    CategoryID VARCHAR(10) PRIMARY KEY,
    CategoryName VARCHAR(255)
);

CREATE TABLE Items (
    ItemID INT PRIMARY KEY AUTO_INCREMENT,
    ItemName VARCHAR(255),
    ItemCategory VARCHAR(10),
    Description TEXT,
    image VARCHAR(200),
    Date DATETIME,
    Price INT,
Sell bit,
    FOREIGN KEY (ItemCategory) REFERENCES ItemCategories(CategoryID)
);


CREATE TABLE RecieptCategories (
    CategoryID VARCHAR(10) PRIMARY KEY,
    CategoryName VARCHAR(255)
);

CREATE TABLE Reciept(
    RecieptID INT PRIMARY KEY AUTO_INCREMENT,
    UserIDBuy INT,
    UserIDSell INT,
    RecieptDate DATETIME,
	RecieptDateEnd DATETIME,
    ItemID INT,
	Price INT,
    CategoryRecieptID VARCHAR(10),
    State BIT,
    FOREIGN KEY (UserIDBuy) REFERENCES Users(UserID),
    FOREIGN KEY (UserIDSell) REFERENCES Users(UserID),
    FOREIGN KEY (ItemID) REFERENCES Items(ItemID),
    FOREIGN KEY (CategoryRecieptID) REFERENCES RecieptCategories(CategoryID)
);

CREATE TABLE NewsCategories (
    CategoryID VARCHAR(10) PRIMARY KEY,
    CategoryName VARCHAR(255)
);

CREATE TABLE News (
    NewsID INT PRIMARY KEY AUTO_INCREMENT,
    Title VARCHAR(255),
    PublishedDate DATETIME,
    AuthorID INT,
    CategoryID VARCHAR(10),
    FOREIGN KEY (AuthorID) REFERENCES Users(UserID),
    FOREIGN KEY (CategoryID) REFERENCES NewsCategories(CategoryID),
    image TEXT
);

CREATE TABLE NewsDetails (
    NewsID INT,
    ImagePath VARCHAR(255),
    Content VARCHAR(500),
    ThuTu INT,
    Form INT,
    FOREIGN KEY (NewsID) REFERENCES News(NewsID)
);

CREATE TABLE OwnedItems (
    ItemID INT,
    OwnerID INT,
    NgaySoHuu DATETIME,
    FOREIGN KEY (ItemID) REFERENCES Items(ItemID),
    FOREIGN KEY (OwnerID) REFERENCES Users(UserID)
);
CREATE TABLE comment (
    NewsID INT,
    UserID INT,
    Message TEXT,
    Date DATE,
    FOREIGN KEY (NewsID) REFERENCES news(NewsID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

INSERT INTO `itemcategories`(`CategoryID`, `CategoryName`) VALUES ('PKM','Quái thú'),('SK','Lá bài phép'),('AC','Lá bẩy');

INSERT INTO `newscategories`(`CategoryID`, `CategoryName`) VALUES (1,'Tin tức'),(2,'Hướng dẫn');

INSERT INTO `recieptcategories`(`CategoryID`, `CategoryName`) VALUES ('DG','Đấu giá'),('SHOP','Cửa hàng');

INSERT INTO `roles`(`RoleID`, `RoleName`) VALUES (NULL,'Khách hàng'),(NULL,'Quản trị');

INSERT INTO `items`(`ItemID`, `ItemName`, `ItemCategory`, `Description`, `image`, `Date`, `Price`, `Sell`) 
VALUES (NULL,'Dark Magician','PKM','Thông tin mô tả','image1.png','2023-10-30 02:53:55','30','1'),
(NULL,'Dark Magician','PKM','Thông tin mô tả','image2.png','2023-10-30 02:53:55','30','1'),
(NULL,'Dark Magician','PKM','Thông tin mô tả','image3.png','2023-10-30 02:53:55','30','1'),
(NULL,'Blue-Eyes White Dragon','PKM','Thông tin mô tả','image4.png','2023-10-30 02:53:55','30','1'),
(NULL,'Red-Eyes Black Dragon','PKM','Thông tin mô tả','image5.png','2023-10-30 02:53:55','30','1'),
(NULL,'Dark Armed Dragon','PKM','Thông tin mô tả','image6.png','2023-10-30 02:53:55','30','1'),
(NULL,'Elemental HERO Neos','PKM','Thông tin mô tả','image7.png','2023-10-30 02:53:55','30','1'),
(NULL,'Black Luster Soldier - Envoy of the Beginning','PKM','Thông tin mô tả','image8.png','2023-10-30 02:53:55','30','1'),
(NULL,'Stardust Dragon','PKM','Thông tin mô tả','image9.png','2023-10-30 02:53:55','30','1'),
(NULL,'Number 39: Utopia','PKM','Thông tin mô tả','image10.png','2023-10-30 02:53:55','30','1'),
(NULL,'Mirror Force','AC','Thông tin mô tả','image11.png','2023-10-30 02:53:55','30','1'),
(NULL,'Torrential Tribute','AC','Thông tin mô tả','image12.png','2023-10-30 02:53:55','32','1'),
(NULL,'Bottomless Trap Hole','AC','Thông tin mô tả','image13.png','2023-10-30 02:53:55','34','1'),
(NULL,'Solemn Judgment','AC','Thông tin mô tả','image14.png','2023-10-30 02:53:55','35','1'),
(NULL,'Compulsory Evacuation Device','AC','Thông tin mô tả','image15.png','2023-10-30 02:53:55','36','1'),
(NULL,'Trap Hole','AC','Thông tin mô tả','image16.png','2023-10-30 02:53:55','37','1'),
(NULL,'Dimensional Prison','AC','Thông tin mô tả','image17.png','2023-10-30 02:53:55','38','1'),
(NULL,'Solemn Strike','AC','Thông tin mô tả','image18.png','2023-10-30 02:53:55','39','1'),
(NULL,'Macro Cosmos','AC','Thông tin mô tả','image19.png','2023-10-30 02:53:55','20','1'),
(NULL,'Fiendish Chain','AC','Thông tin mô tả','image20.png','2023-10-30 02:53:55','30','1'),
(NULL,'Raigeki','SK','Thông tin mô tả','image21.png','2023-10-30 02:53:55','30','1'),
(NULL,'Pot of Greed','SK','Thông tin mô tả','image22.png','2023-10-30 02:53:55','500','1'),
(NULL,'Dark Hole','SK','Thông tin mô tả','image23.png','2023-10-30 02:53:55','30','1'),
(NULL,'Mystical Space Typhoon','SK','Thông tin mô tả','image24.png','2023-10-30 02:53:55','30','1'),
(NULL,'Monster Reborn','SK','Thông tin mô tả','image25.png','2023-10-30 02:53:55','30','1'),
(NULL,'Harpies Feather Duster','SK','Thông tin mô tả','image26.png','2023-10-30 02:53:55','30','1'),
(NULL,'Heavy Storm','SK','Thông tin mô tả','image27.png','2023-10-30 02:53:55','30','1'),
(NULL,'Graceful Charity','SK','Thông tin mô tả','image28.png','2023-10-30 02:53:55','30','1'),
(NULL,'Card of Demise','SK','Thông tin mô tả','image29.png','2023-10-30 02:53:55','30','1'),
(NULL,'Mind Control','SK','Thông tin mô tả','image30.png','2023-10-30 02:53:55','30','1');

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `NgayTao`, `IDRole`, `level`, `Rank`, `SoDu`, `Win`, `imageus`) VALUES (NULL, 'NguoiDung1', '123', 'mot@gmail.com', '2023-11-18 22:08:24', '1', '1', '1', '1', '1', 'default.png'),(NULL, 'NguoiDung2', '123', 'hai@gmail.com', '2023-11-18 22:08:24', '1', '1', '1', '1', '1', 'default.png');

INSERT INTO `news`(`NewsID`, `Title`, `PublishedDate`, `AuthorID`, `CategoryID`, `image`) VALUES (NULL,'Yu-Gi-Oh! TCG Banlist Update','2023-10-30 02:53:55','2','1','tintuc1.png'),
(NULL,'Dark Magician Support Cards Revealed','2023-10-30 02:53:55','2','1','tintuc2.png'),
(NULL,'Yu-Gi-Oh! Anime Series Renewed for Another Season','2023-10-30 02:53:55','2','1','tintuc3.png'),
(NULL,'Top Decks from Recent Regional Tournament','2023-10-30 02:53:55','2','1','tintuc4.png'),
(NULL,'New Structure Deck: Cyber Dragon Revolution','2023-10-30 02:53:55','2','1','tintuc5.png');

INSERT INTO `newsdetails`(`NewsID`, `ImagePath`, `Content`, `ThuTu`, `Form`) VALUES (1,'tintuc1-1.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','1'),
(1,'tintuc1-2.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với ay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','3'),
(1,'tintuc1-3.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','2'),

(1,'tintuc1-4.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','3'),
(2,'tintuc1-1.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','3'),
(2,'tintuc1-2.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với ay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','2'),
(2,'tintuc1-3.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','1'),

(2,'tintuc1-4.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','1'),
(3,'tintuc1-1.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','2'),
(3,'tintuc1-2.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với ay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','1'),
(3,'tintuc1-3.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','2'),

(3,'tintuc1-4.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','1'),
(5,'tintuc1-1.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','2'),
(5,'tintuc1-2.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với ay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','1'),
(5,'tintuc1-3.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','2'),

(5,'tintuc1-4.png','Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.Nội dung: Hãy cùng xem xét các thay đổi mới nhất trong danh sách cấm và giới hạn của Yu-Gi-Oh! Trading Card Game và tác động của chúng đối với môi trường chơi.','2023-10-30 02:54:55','1');





