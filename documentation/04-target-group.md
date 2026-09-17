# Target Group Configuration

## 1. Create Target Group

After launching the WordPress EC2 instance, I created a Target Group to connect the EC2 instance with the Application Load Balancer.

### Steps

1. Open the **AWS Management Console**.
2. Go to **EC2**.
3. Select **Target Groups** from the left navigation menu.
4. Click **Create target group**.

## 2. Choose Target Type

Under **Choose a target type**, select:

```text
Instances
```

This allows EC2 instances to be registered as targets.

## 3. Configure Target Group

Configure the Target Group as follows:

```text
Target Type        : Instances
Target Group Name  : WordPress-TG
Protocol           : HTTP
Port               : 80
VPC                : Same VPC used by the EC2 instance
```

## 4. Configure Health Check

Configure the health check to verify whether the WordPress application is available.

```text
Health Check Protocol : HTTP
Health Check Path     : /
Health Check Port     : Traffic Port
```

The health check path can be an application page that successfully responds from the WordPress server.

## 5. Register EC2 Instance

After configuring the Target Group:

1. Go to **Register targets**.
2. Select the WordPress EC2 instance.
3. Confirm port **80**.
4. Add the instance to the registered targets.
5. Click **Create target group**.

## 6. Verify Target Health

After creating the Target Group:

1. Open **EC2 → Target Groups**.
2. Select `WordPress-TG`.
3. Open the **Targets** tab.
4. Check the registered EC2 instance.
5. Verify the health status.

Expected status:

```text
Healthy
```

The Target Group health check verifies whether the WordPress application is responding correctly.

## 7. Target Group Flow

```text
User
  ↓
Application Load Balancer
  ↓
WordPress-TG
  ↓
Healthy EC2 Instance
  ↓
WordPress
  ↓
Amazon RDS MySQL
```

## 8. What I Learned

Through this configuration, I learned:

* How to create a Target Group.
* How to select EC2 instances as targets.
* How to register an EC2 instance with a Target Group.
* How to configure an HTTP health check.
* How to verify the health status of an EC2 target.
* How a Target Group connects the Application Load Balancer with EC2 instances.

## 9. Result

The **WordPress Target Group** was successfully created, the WordPress EC2 instance was registered as a target, and the health check was configured to verify the application availability.
