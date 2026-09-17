# WordPress EC2 + RDS MySQL Setup

## 1. Project Overview

In this project, I deployed a WordPress application on an Amazon EC2 instance using a LAMP stack and connected WordPress to an Amazon RDS MySQL database.

### Architecture Flow

```text
Amazon Linux 2023 EC2
        ↓
      Apache
        ↓
       PHP
        ↓
    WordPress
        ↓
   Amazon RDS MySQL
```

---

## 2. Launch EC2 Instance

I launched an **Amazon Linux 2023** EC2 instance for the WordPress application server.

### EC2 Configuration

```text
AMI              : Amazon Linux 2023
VPC              : Selected VPC
Security Group   : Selected/Default Security Group
Other Settings   : Default
Purpose          : WordPress Application Server
```

After launching the instance, I verified that the EC2 instance was running.

---

## 3. Create Amazon RDS MySQL

I created an **Amazon RDS MySQL** database for storing the WordPress application data.

### RDS Configuration

```text
Database Engine  : MySQL
Public Access    : No
Database         : WordPress
```

The RDS database is used as the backend database for WordPress.

---

## 4. Install MySQL Client on EC2

I installed the MariaDB/MySQL client on the EC2 instance to connect to the RDS MySQL database.

```bash
dnf install -y mariadb105
```

The project notes use the MariaDB 10.5 client package for the connection.

---

## 5. Configure RDS Endpoint

I configured the RDS endpoint as the MySQL host.

```bash
export MYSQL_HOST=<RDS_ENDPOINT>
```

The RDS endpoint is used by the EC2 instance to connect to the MySQL database.

---

## 6. Connect EC2 to RDS

I connected to the RDS MySQL database from the EC2 instance using the MySQL client.

```bash
mysql -h <RDS_ENDPOINT> -P 3306 -u admin -p
```

Port `3306` is used for the MySQL connection.

---

## 7. Create WordPress Database and User

After connecting to RDS, I created the WordPress database and database user.

```sql
CREATE DATABASE wordpress;

CREATE USER 'wpuser' IDENTIFIED BY '<DB_PASSWORD>';

GRANT ALL PRIVILEGES ON wordpress.* TO wpuser;

FLUSH PRIVILEGES;
```

I used a separate database user for the WordPress application.


The original project notes contain the database creation and privilege commands.

---

## 8. Install Apache

I installed the Apache web server on the Amazon Linux EC2 instance.

```bash
sudo yum install -y httpd
```

Start Apache:

```bash
sudo service httpd start
```

Apache is used as the web server for the WordPress application.

---

## 9. Download WordPress

I downloaded the WordPress package on the EC2 instance.

```bash
wget https://wordpress.org/latest.tar.gz
```

Extract the package:

```bash
tar -xzf latest.tar.gz
```

Enter the WordPress directory:

```bash
cd wordpress
```

The original project notes use the official WordPress package for the deployment.

---

## 10. Create WordPress Configuration File

I created the WordPress configuration file from the sample configuration.

```bash
cp wp-config-sample.php wp-config.php
```

Then I edited the configuration:

```bash
vi wp-config.php
```

The following database values were configured:

```php
define( 'DB_NAME', 'wordpress' );
define( 'DB_USER', '<DB_USERNAME>' );
define( 'DB_PASSWORD', '<DB_PASSWORD>' );
define( 'DB_HOST', '<RDS_ENDPOINT>' );
```

The `DB_HOST` value is the RDS MySQL endpoint.

---

## 11. Configure WordPress Security Keys

WordPress security keys can be generated using:

```text
https://api.wordpress.org/secret-key/1.1/salt/
```

The generated values are added to `wp-config.php`.

>
---

## 12. Install PHP Dependencies

I installed PHP and the MySQL PHP dependency required by WordPress.

```bash
dnf install -y php8.4 php-mysqlnd
```

The original project notes use these packages for the WordPress setup.

---

## 13. Deploy WordPress to Apache

I copied the WordPress application files to the Apache web root.

```bash
cd /home/ec2-user

sudo cp -r wordpress/* /var/www/html/
```

Then I restarted Apache:

```bash
sudo service httpd restart
```

I also enabled Apache to start automatically:

```bash
systemctl enable httpd
```

---

## 14. Access WordPress

After completing the server configuration, I opened the EC2 public IP address in a web browser.

```text
http://<EC2_PUBLIC_IP>
```

The WordPress installation page is displayed in the browser.

For the WordPress administration page:

```text
http://<EC2_PUBLIC_IP>/wp-admin
```

For the main website:

```text
http://<EC2_PUBLIC_IP>
```

The original project notes specify accessing WordPress through the EC2 public IP and using `/wp-admin` for the administration page.

---

## 15. Final Application Flow


User
  ↓
EC2 Public IP
  ↓
Apache
  ↓
PHP
  ↓
WordPress
  ↓
RDS MySQL
```

---

## 16. What I Learned

Through this implementation, I learned:

* How to launch an Amazon Linux 2023 EC2 instance.
* How to install and configure Apache.
* How to install PHP and the MySQL PHP dependency.
* How to install the MySQL client on EC2.
* How to connect EC2 to an RDS MySQL database.
* How to create a WordPress database and database user.
* How to configure WordPress using `wp-config.php`.
* How to deploy WordPress on an Apache web server.
* How WordPress uses Amazon RDS as its backend database.

---

## 17. Result

The WordPress application was successfully deployed on an Amazon Linux 2023 EC2 instance using Apache and PHP.

The WordPress application was configured to use **Amazon RDS MySQL** as its database.

```text
EC2
 ├── Amazon Linux 2023
 ├── Apache
 ├── PHP
 └── WordPress
          ↓
     Amazon RDS MySQL
```

## Security Note

Never upload the following information to GitHub:

* Real database passwords
* AWS Access Keys
* AWS Secret Keys
* Private keys
* Real `wp-config.php`
* Real WordPress security keys

Use placeholders such as:

```text
<RDS_ENDPOINT>
<DB_USERNAME>
<DB_PASSWORD>
```
