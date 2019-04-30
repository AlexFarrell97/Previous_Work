CREATE TABLE BRANCH (
	branchID		VARCHAR2(10),
	addressLine1	VARCHAR2(20),
	addressLine2	VARCHAR2(20),
	townCity		VARCHAR2(20),
	postCode		VARCHAR2(7),
	telephone1		VARCHAR2(13),
	telephone2		VARCHAR2(13),
	PRIMARY KEY (branchID));
	
CREATE TABLE ROOM (
	roomID			VARCHAR2(10),
	branchID		VARCHAR2(10),
	roomSize		VARCHAR2(6),
	roomType		VARCHAR2(9),
	PRIMARY KEY (roomID),
	FOREIGN KEY (branchID) REFERENCES BRANCH(branchID) ON DELETE CASCADE);
	
CREATE TABLE EMPLOYEE (
	employeeID		VARCHAR2(10),
	branchID		VARCHAR2(10),
	title			VARCHAR2(10),
	firstName		VARCHAR2(20),
	lastName		VARCHAR2(20),
	email			VARCHAR2(50),
	telephone1		VARCHAR2(13),
	telephone2		VARCHAR2(13),
	PRIMARY KEY (employeeID),
	FOREIGN KEY (branchID) REFERENCES BRANCH(branchID) ON DELETE CASCADE);
	
CREATE TABLE CUSTOMER (
	customerID		VARCHAR2(10),
	email			VARCHAR2(50),
	addressLine1	VARCHAR2(20),
	addressLine2	VARCHAR2(20),
	townCity		VARCHAR2(20),
	postCode		VARCHAR2(7),
	telephone1		VARCHAR2(13),
	telephone2		VARCHAR2(13),
	PRIMARY KEY (customerID));
	
CREATE TABLE CUSTOMERSTD (
	customerID		VARCHAR2(10),
	title			VARCHAR2(10),
	firstName		VARCHAR2(20),
	lastName		VARCHAR2(20),
	PRIMARY KEY (customerID),
	FOREIGN KEY (customerID) REFERENCES CUSTOMER(customerID) ON DELETE CASCADE);
	
CREATE TABLE CUSTOMERBUS (
	customerID		VARCHAR2(10),
	companyName		VARCHAR2(50),
	repLastName		VARCHAR2(20),
	invoiceNumber	NUMBER,
	PRIMARY KEY (customerID),
	FOREIGN KEY (customerID) REFERENCES CUSTOMER(customerID) ON DELETE CASCADE);
		
CREATE TABLE BOOKING (
	bookingID		VARCHAR2(10),
	bookingDate		DATE,
	startTime		DATE,
	endTime			DATE,
	reason			VARCHAR2(50),
	totalPeople		NUMBER,
	paymentMethod	VARCHAR2(7),
	arrived			NUMBER(1),
	PRIMARY KEY (bookingID));
	
CREATE TABLE BOOKINGSTD (
	bookingID		VARCHAR2(10),
	roomID			VARCHAR2(10),
	customerID		VARCHAR2(10),
	decColour		VARCHAR2(10),
	PRIMARY KEY (bookingID, roomID, customerID),
	FOREIGN KEY (bookingID) REFERENCES BOOKING(bookingID) ON DELETE CASCADE,
	FOREIGN KEY (roomID) REFERENCES ROOM(roomID) ON DELETE CASCADE,
	FOREIGN KEY (customerID) REFERENCES CUSTOMER(customerID) ON DELETE CASCADE);
	
CREATE TABLE BOOKINGEX (
	bookingID		VARCHAR2(10),
	roomID			VARCHAR2(10),
	customerID		VARCHAR2(10),
	buffetType		VARCHAR2(20),
	PRIMARY KEY (bookingID, roomID, customerID),
	FOREIGN KEY (bookingID) REFERENCES BOOKING(bookingID) ON DELETE CASCADE,
	FOREIGN KEY (roomID) REFERENCES ROOM(roomID) ON DELETE CASCADE,
	FOREIGN KEY (customerID) REFERENCES CUSTOMER(customerID) ON DELETE CASCADE);
	
CREATE TABLE PRODUCT (
	productID		VARCHAR2(10),
	productName		VARCHAR2(20),
	theme			VARCHAR2(20),
	PRIMARY KEY (productID));
	
CREATE TABLE PRODORDER (
	orderID			VARCHAR2(10),
	branchID		VARCHAR2(10),
	productID		VARCHAR2(10),
	quantity		NUMBER,
	dateOrdered		DATE,
	PRIMARY KEY (orderID),
	FOREIGN KEY (branchID) REFERENCES BRANCH(branchID) ON DELETE CASCADE,
	FOREIGN KEY (productID) REFERENCES PRODUCT(productID) ON DELETE CASCADE);
	
CREATE TABLE SUPPLIER (
	supplierID		VARCHAR2(10),
	supplierName	VARCHAR2(50),
	telephone1		VARCHAR2(13),
	telephone2		VARCHAR2(13),
	email			VARCHAR2(50),
	addressLine1	VARCHAR2(20),
	addressLine2	VARCHAR2(20),
	townCity		VARCHAR2(20),
	postCode		VARCHAR2(7),
	PRIMARY KEY (supplierID));
	
CREATE TABLE BRANCHSTOCK (
	branchID		VARCHAR2(10),
	productID		VARCHAR2(10),
	supplierID		VARCHAR2(10),
	stockLevel		NUMBER,
	minStockLevel	NUMBER,
	PRIMARY KEY (branchID, productID),
	FOREIGN KEY (branchID) REFERENCES BRANCH(branchID) ON DELETE CASCADE,
	FOREIGN KEY (productID) REFERENCES PRODUCT(productID) ON DELETE CASCADE,
	FOREIGN KEY (supplierID) REFERENCES SUPPLIER(supplierID) ON DELETE CASCADE);