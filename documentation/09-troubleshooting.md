# Troubleshooting

## 1. Overview

During the implementation of this project, troubleshooting was performed whenever a service or application component did not work as expected.

The troubleshooting process was based on checking the AWS resource status, configuration, network connectivity, Security Groups, application services, and logs.

---

## 2. EC2 Troubleshooting

### Problem

If the EC2 instance is not accessible:

### Checks

* Check whether the EC2 instance is in the `Running` state.
* Check the EC2 status checks.
* Verify the Key Pair.
* Check the Security Group configuration.
* Verify the required network configuration.

### What I Learned

I learned how to verify EC2 instance status and troubleshoot basic connectivity problems.

---

## 3. EC2 to RDS Connectivity

### Problem

If the EC2 instance cannot connect to the RDS MySQL database:

### Checks

* Verify the RDS instance status.
* Verify the RDS endpoint.
* Verify MySQL port `3306`.
* Check the Security Group configuration.
* Verify the database username and password.
* Verify that the WordPress database exists.

### MySQL Connection Test

```bash
mysql -h <RDS_ENDPOINT> -P 3306 -u <DB_USERNAME> -p
```

### What I Learned

I learned how to troubleshoot connectivity between an EC2 application server and an RDS MySQL database.

---

## 4. WordPress Troubleshooting

### Problem

If the WordPress website does not open:

### Checks

* Check whether Apache is running.
* Check the WordPress files in `/var/www/html/`.
* Check the `wp-config.php` configuration.
* Verify the RDS endpoint.
* Verify the WordPress database name.
* Verify the database username and password.

### Apache Check

```bash
systemctl status httpd
```

### Restart Apache

```bash
sudo systemctl restart httpd
```

### What I Learned

I learned how to troubleshoot WordPress application and Apache configuration issues.

---

## 5. Target Group Troubleshooting

### Problem

If the Target Group shows the EC2 instance as unhealthy:

### Checks

* Verify that the EC2 instance is running.
* Verify that the application is running.
* Check the Target Group health check path.
* Verify HTTP port `80`.
* Check the Security Group configuration.

### What I Learned

I learned how Target Group health checks are used to verify application availability.

---

## 6. Application Load Balancer Troubleshooting

### Problem

If the application cannot be accessed through the ALB:

### Checks

* Verify that the ALB is active.
* Check the listener configuration.
* Verify the Target Group.
* Check whether the registered targets are healthy.
* Check the ALB Security Group.

### What I Learned

I learned how to troubleshoot the connection between the ALB, Target Group, and EC2 instances.

---

## 7. Auto Scaling Troubleshooting

### Problem

If the Auto Scaling Group does not launch the expected EC2 instances:

### Checks

* Verify the Launch Template.
* Verify the AMI.
* Check the instance type.
* Check the selected VPC and subnets.
* Check the Auto Scaling Group desired, minimum, and maximum capacity.
* Check the ASG activity history.

### What I Learned

I learned how to troubleshoot EC2 instance launches through an Auto Scaling Group.

---

## 8. RDS Blue/Green Troubleshooting

### Problem

If the Green environment is not ready for testing or switchover:

### Checks

* Verify the Green environment status.
* Check asynchronous replication.
* Verify database availability.
* Test database connectivity.
* Validate the application before performing the switchover.

### What I Learned

I learned how to validate the Green environment before performing a Blue-to-Green switchover.

---

## 9. Troubleshooting Approach

For AWS application problems, I followed a step-by-step troubleshooting approach:

```text
Identify the Problem
        ↓
Check AWS Resource Status
        ↓
Check Configuration
        ↓
Check Security Group
        ↓
Check Network Connectivity
        ↓
Check Application Service
        ↓
Check Logs / Health Status
        ↓
Apply Fix
        ↓
Test Again
```

---

## 10. What I Learned

Through troubleshooting, I learned that AWS application problems can be investigated systematically by checking:

* EC2 status
* Security Groups
* RDS connectivity
* Apache service
* WordPress configuration
* Target Group health
* ALB listener configuration
* Auto Scaling configuration
* RDS Blue/Green environment status

> Only actual errors encountered during the project should be added to this file with their exact error message, root cause, solution, and result.
