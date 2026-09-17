# Auto Scaling Group Configuration

## 1. Overview

After creating the WordPress AMI and Launch Template, I created an **Auto Scaling Group (ASG)** using the WordPress Launch Template.

The purpose of the Auto Scaling Group is to manage EC2 instances automatically and provide a scalable environment for the WordPress application.

## 2. Prerequisites

Before creating the Auto Scaling Group, the following resources were prepared:

* WordPress EC2 instance
* WordPress AMI
* WordPress Launch Template
* VPC
* Subnet
* Security Group
* Application Load Balancer
* Target Group

## 3. Create Auto Scaling Group

1. Open the **AWS Management Console**.
2. Go to **EC2**.
3. Select **Auto Scaling Groups** from the left navigation menu.
4. Click **Create Auto Scaling group**.

## 4. Enter Auto Scaling Group Name

Enter the ASG name:

```text id="5e8d3n"
WordPress-ASG
```

## 5. Select Launch Template

Under **Launch Template**:

* Select `WordPress-Launch-Template`.
* Select the required Launch Template version.

The Launch Template contains the configuration required to launch the WordPress EC2 instances.

## 6. Configure Network

Select the VPC used by the application.

Select the required subnets where the EC2 instances should be launched.

Example:

```text id="u5f0ha"
VPC      → Selected project VPC
Subnets  → Selected application subnets
```

## 7. Configure Load Balancing

Connect the Auto Scaling Group with the existing **Target Group**.

The flow becomes:

```text id="4n8w7g"
User
 ↓
Application Load Balancer
 ↓
Target Group
 ↓
Auto Scaling Group
 ↓
EC2 WordPress Instances
```

The Target Group performs health checks on the EC2 instances.

## 8. Configure Group Size

Configure the required number of instances.

Example configuration:

```text id="qbyj4w"
Desired Capacity → Required number of instances
Minimum Capacity → Minimum number of instances
Maximum Capacity → Maximum number of instances
```

Use the actual values configured in the AWS environment when documenting the project.

## 9. Configure Health Checks

Enable the required health check configuration.

The Auto Scaling Group can use EC2 health checks to determine whether an instance is healthy.

When an unhealthy instance is detected, the Auto Scaling Group can replace it according to its configuration.

## 10. Review and Create

Review the complete configuration:

```text id="q0ik7z"
Auto Scaling Group → WordPress-ASG
Launch Template    → WordPress-Launch-Template
AMI                → WordPress-AMI
VPC                → Selected VPC
Subnets            → Selected Subnets
Target Group       → WordPress Target Group
Desired Capacity   → Configured value
Minimum Capacity   → Configured value
Maximum Capacity   → Configured value
```

Click **Create Auto Scaling group**.

## 11. Verify Auto Scaling Group

After creating the ASG:

1. Open **EC2 → Auto Scaling Groups**.
2. Select `WordPress-ASG`.
3. Check the **Instance management** section.
4. Verify that the required EC2 instances are launched.
5. Check the Target Group.
6. Verify that the registered EC2 instances become **Healthy**.

## 12. Auto Scaling Architecture

```text
                 User
                   ↓
          Application Load Balancer
                   ↓
              Target Group
                   ↓
          ┌─────────────────┐
          │ Auto Scaling    │
          │     Group       │
          └─────────────────┘
             ↓           ↓
        EC2 Instance  EC2 Instance
             ↓           ↓
          WordPress   WordPress
             \           /
              \         /
               Amazon RDS
                 MySQL
```

## 13. What I Learned

Through this implementation, I learned:

* What an Auto Scaling Group is.
* How to create an Auto Scaling Group.
* How to use a Launch Template with an ASG.
* How AMI is used to launch identical EC2 instances.
* How Auto Scaling works with a Target Group.
* How a Load Balancer distributes application traffic.
* How health checks help maintain healthy application instances.
* How Auto Scaling provides scalability and availability.

## 14. Result

The **WordPress Auto Scaling Group** was successfully configured using the **WordPress Launch Template**.

The EC2 instances launched by the Auto Scaling Group are registered with the Target Group and can receive traffic through the Application Load Balancer.
