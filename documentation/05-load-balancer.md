# Application Load Balancer Configuration

For the complete Target Group procedure, see [Target Group Configuration](04-target-group.md).

## 1. Overview

After configuring the WordPress EC2 instances, I configured an **Application Load Balancer (ALB)** to provide access to the WordPress application through a single endpoint.

The ALB works with a **Target Group**, which contains the EC2 instances running the WordPress application.

## 2. Prerequisites

Before creating the Application Load Balancer, the following resources were prepared:

* WordPress EC2 instance
* WordPress AMI
* Launch Template
* Auto Scaling Group
* VPC
* Subnets
* Security Group

## 3. Create Target Group

First, I created a Target Group for the WordPress EC2 instances.

### Steps

1. Open **AWS Management Console**.
2. Go to **EC2**.
3. Select **Target Groups**.
4. Click **Create target group**.
5. Select the target type according to the EC2-based application.
6. Enter the Target Group name:

```text id="q8b11s"
WordPress-TG
```

7. Select the required VPC.
8. Configure the health check.

### Health Check

The project notes specify using a health check path such as:

```text id="qg9a1n"
/
```

or an available application page such as:

```text id="r7dfm2"
readme.html
```

or:

```text id="x7k0m1"
index.php
```

9. Register the WordPress EC2 instance as a target.
10. Create the Target Group.

The Target Group is used to check the health of the application instances and route traffic to registered healthy targets.

---

# 4. Create Application Load Balancer

After creating the Target Group, I created an **Application Load Balancer**.

### Steps

1. Go to **EC2 → Load Balancers**.
2. Click **Create Load Balancer**.
3. Select **Application Load Balancer**.
4. Enter the Load Balancer name:

```text id="b2x8o3"
WordPress-ALB
```

## 5. Configure Scheme

Select the required scheme for the application.

For an internet-facing WordPress website, configure the ALB according to the application's network requirements.

## 6. Configure Network Mapping

Select:

* VPC used by the application
* Required Availability Zones
* Required subnets

The ALB should be configured with the appropriate subnets for the application.

## 7. Configure Security Group

Select or configure the Security Group required for the ALB.

The Security Group should allow the traffic required to access the WordPress application.

## 8. Configure Listener

Configure the required listener for the application.

The listener receives incoming client requests and forwards them to the configured Target Group.

Example flow:

```text id="a9g8j7"
Client Request
      ↓
ALB Listener
      ↓
WordPress Target Group
      ↓
Healthy EC2 Instance
```

## 9. Select Target Group

Configure the listener to forward requests to:

```text id="f1z7q8"
WordPress-TG
```

10. Review the configuration.
11. Click **Create Load Balancer**.

---

# 10. Verify Target Health

After creating the ALB:

1. Open **EC2 → Target Groups**.
2. Select `WordPress-TG`.
3. Open the **Targets** tab.
4. Check the registered EC2 instances.
5. Verify the health status.

Expected status:

```text id="d9k4w2"
Healthy
```

The health check verifies whether the WordPress application is responding correctly.

---

# 11. Access WordPress Through ALB

After the ALB is created:

1. Go to **EC2 → Load Balancers**.
2. Select `WordPress-ALB`.
3. Copy the **DNS name**.
4. Open the ALB DNS name in a browser.

Example:

```text id="s3x8n1"
http://<ALB-DNS-NAME>
```

The request flow is:

```text id="u7m2k9"
User
 ↓
Application Load Balancer
 ↓
Listener
 ↓
Target Group
 ↓
Healthy WordPress EC2
 ↓
WordPress
 ↓
RDS MySQL
```

---

# 12. ALB with Auto Scaling

The Application Load Balancer can work together with the Auto Scaling Group.

```text id="k8p4v1"
                 User
                   ↓
          Application Load Balancer
                   ↓
              Target Group
              ↙          ↘
       EC2 Instance    EC2 Instance
              ↘          ↙
              WordPress
                   ↓
             Amazon RDS
               MySQL
```

When EC2 instances are managed by the Auto Scaling Group, the instances can be registered with the Target Group and receive application traffic through the ALB.

---

# 13. What I Learned

Through this implementation, I learned:

* What an Application Load Balancer is.
* How to create a Target Group.
* How to register EC2 instances with a Target Group.
* How to configure health checks.
* How to create an Application Load Balancer.
* How listeners forward requests to a Target Group.
* How ALB works with EC2 instances.
* How ALB works together with Auto Scaling.

---

# 14. Result

The **Application Load Balancer** was successfully configured with a **Target Group** containing the WordPress EC2 application.

The WordPress application can be accessed through the ALB DNS name, and the Target Group health check is used to verify the health of the registered application instances.
