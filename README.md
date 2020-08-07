# 2.nd Sprint project :: 
## Login : name, Password : password
#### -v Beta
#### C.R.U.D.
To test the C.R.U.D. please open your MySQL workbench, make a connection for:
Username: root 
Password: mysql
Servername: localhost
and then do the following code:

    CREATE DATABASE esybes_ir_rysiai;


        CREATE TABLE esybes_ir_rysiai.staff (
            StaffID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            First_name varchar(30) NOT NULL,
            Last_name varchar(30) NOT NULL,
            Role varchar(30) NOT NULL,
            ProjectID int DEFAULT NULL
            );
        CREATE TABLE esybes_ir_rysiai.projects (
            ProjectID INT PRIMARY KEY NOT NULL AUTO_INCREMENT, -- Must contain 3 numbers
            Project_name varchar(30) NOT NULL,
            Deadline varchar(255) DEFAULT NULL
            );
            

                -- OPTIONAL CODE FOR IMMEDIATE TESTING
                INSERT INTO esybes_ir_rysiai.staff VALUES (1,'Tadas','Blinda','Associate VFX Artist',120),
                (2,'Robin','Hood','Concept Artist',101),
                (3,'Sylvester','Stalone','Character Artist',112),
                (4,'John','Doe','Senior Software Engineer',104),
                (5,'Marry','Poppins','Level Designer',102),
                (22,'Cherry','Lady','Motion Designer',101),
                (25,'Ajaxa','Xunamun','Warrior',105);
                INSERT INTO esybes_ir_rysiai.projects VALUES (101,'Project Phantom','2020-09-29'),
                (102,'Bugati Simulator','2020-08-29'),
                (103,'The Call Of C\'thulhu','2020-12-31'),
                (104,'Rise Of Pantheon','2020-11-22'),
                (105,'Flying Dead','2020-10-18'),
                (112,'Runescape','2023-05-04'),
                (133,'New game','2020-08-07');
                -- OPTIONAL CODE FOR IMMEDIATE TESTING end

