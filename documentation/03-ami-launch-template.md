# AMI Creation and Launch Template Configuration

## 1. Create AMI from the WordPress EC2 Instance

After successfully configuring the WordPress application on the EC2 instance, I created an Amazon Machine Image (AMI) from the configured EC2 instance.

The purpose of creating an AMI is to create a reusable image of the configured WordPress server. This AMI can then be used to launch additional EC2 instances with the same application configuration.

### Steps to Create AMI

1. Open the **AWS Management Console**.
2. Go to **EC2**.
3. Select **Instances** from the left navigation menu.
4. Select the configured **WordPress EC2 instance**.
5. Click **Actions**.
6. Select:

```text
Actions
→ Image and templates
→ Create image
```

7. Enter the following AMI name:

```text
WordPress-AMI
```

8. Add a description:

```text
AMI created from the configured WordPress EC2 instance.
```

9. Review the block device configuration.
10. Keep the existing storage configuration.
11. Click **Create image**.

### Verify AMI

After creating the AMI:

1. Go to **EC2 → AMIs**.
2. Select **Owned by me**.
3. Find the `WordPress-AMI`.
4. Wait until the AMI status changes to:

```text
Available
```

The AMI is now ready to be used for launching new EC2 instances.

---

# 2. Create Launch Template

After creating the WordPress AMI, I created a Launch Template using the custom AMI.

A Launch Template stores the configuration required to launch EC2 instances. It can later be used by an Auto Scaling Group to launch additional instances.

### Steps to Create Launch Template

1. Go to **AWS Management Console → EC2**.
2. Select **Launch Templates** from the left navigation menu.
3. Click **Create launch template**.
4. Enter the Launch Template name:

```text
WordPress-Launch-Template
```

5. Add a description:

```text
Launch Template for launching WordPress EC2 instances using WordPress-AMI.
```

## 3. Select AMI

Under **Application and OS Images (AMI)**:

1. Select **My AMIs**.
2. Select **Owned by me**.
3. Select the previously created:

```text
WordPress-AMI
```

This ensures that new EC2 instances are launched with the same WordPress application configuration.

## 4. Select Instance Type

Select the required EC2 instance type.

For a Free Tier/practice environment, use an instance type that is currently eligible for the applicable AWS Free Tier offer.

> Free Tier eligibility depends on the AWS account and current AWS pricing/Free Tier offer. Verify eligibility before launching resources.

## 5. Configure Key Pair

Select the required EC2 Key Pair.

The Key Pair is used to securely connect to the Linux EC2 instance.

## 6. Configure Network Settings

Configure the networking according to the application.

For this project:

```text
VPC              → Required/selected VPC
Security Group   → Application Security Group
```

The Security Group should allow the traffic required by the WordPress application.

## 7. Configure Storage

Keep the storage configuration according to the original WordPress EC2 instance requirements.

No additional storage configuration is required unless the application needs it.

## 8. Review and Create Launch Template

Review the configuration:

```text
Launch Template Name : WordPress-Launch-Template
AMI                  : WordPress-AMI
Instance Type        : Selected instance type
Key Pair             : Selected Key Pair
VPC                  : Selected VPC
Security Group       : Selected Security Group
Storage              : Configured storage
```

Click:

**Create launch template**

## 9. Verify Launch Template

Go to:

**EC2 → Launch Templates**

Verify that:

```text
WordPress-Launch-Template
```

has been successfully created.

---

# 10. Launch EC2 Instance Using Launch Template

The Launch Template can be used to launch a new EC2 instance.

### Steps

1. Open **EC2 → Launch Templates**.
2. Select `WordPress-Launch-Template`.
3. Select **Actions**.
4. Choose **Launch instance from template**.
5. Select the required version of the Launch Template.
6. Review the configuration.
7. Launch the EC2 instance.

The new instance will use the **WordPress-AMI** and therefore contain the application configuration captured in the AMI.

---

# 11. Use Launch Template with Auto Scaling Group

The Launch Template can also be used to create an Auto Scaling Group.

The project flow is:

```text
WordPress EC2 Instance
          ↓
      Create AMI
          ↓
    WordPress-AMI
          ↓
   Launch Template
          ↓
WordPress-Launch-Template
          ↓
Auto Scaling Group
          ↓
Additional EC2 Instances
```

The project notes specify creating a Launch Template using the WordPress AMI and then creating an Auto Scaling Group with that Launch Template.

---

# 12. Why AMI is Used

The AMI contains the configured server environment required to launch another EC2 instance.

In this project, the original EC2 instance contains the WordPress application configuration. Creating an AMI from this instance allows the same server configuration to be reused.

---

# 13. Why Launch Template is Used

The Launch Template stores the EC2 launch configuration.

It can be used to consistently launch EC2 instances with the required:

* AMI
* Instance type
* Key Pair
* Network configuration
* Security Group
* Storage configuration

It is also used as the configuration source for the Auto Scaling Group.

---

# 14. What I Learned

Through this implementation, I learned:

* How to create an AMI from an existing EC2 instance.
* How to create a reusable server image.
* How to create a Launch Template using a custom AMI.
* How to launch an EC2 instance from a Launch Template.
* How Launch Templates are used with Auto Scaling Groups.
* How a configured application server can be replicated using AMI-based EC2 deployment.

---

# 15. Final Result

The WordPress EC2 instance was successfully converted into a reusable **WordPress AMI**.

A **Launch Template** was then created using the custom AMI. The Launch Template can be used to launch additional WordPress EC2 instances and can be attached to an **Auto Scaling Group** for scalable application deployment.
