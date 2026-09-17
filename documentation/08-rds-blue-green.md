# RDS Blue/Green Deployment

## 1. Overview

RDS Blue/Green Deployment is used to create a separate Green environment for testing changes before switching the application from the existing Blue environment to the Green environment.

In this project, the existing RDS environment is considered the **Blue environment**, and the new RDS environment is considered the **Green environment**.

The purpose of this setup is to test the new database environment before performing the switchover.

## 2. Blue and Green Environment

### Blue Environment

The Blue environment represents the current database environment used by the application.

```text
Blue
↓
Current / Primary RDS
↓
WordPress Database
```

### Green Environment

The Green environment represents the new database environment created for testing and deployment.

```text
Green
↓
Standby RDS
↓
WordPress Database
```

## 3. Application Architecture

The WordPress application is hosted on EC2 and uses Amazon RDS MySQL as its database.

```text
User
 ↓
Application Load Balancer
 ↓
Target Group
 ↓
WordPress EC2
 ↓
Amazon RDS MySQL
```

The project also uses an AMI, Launch Template, and Auto Scaling Group for the WordPress application environment.

## 4. Create the Green Environment

The Green environment is created as a separate environment for the new database version/configuration.

The purpose is to allow testing without immediately changing the existing Blue environment.

```text
Blue RDS
   ↓
Green RDS
```

## 5. Data Replication

The project uses **asynchronous replication** between the Blue and Green database environments.

```text
Blue RDS
   │
   │ Asynchronous Replication
   ↓
Green RDS
```

This allows the Green environment to receive changes from the Blue environment while the existing application continues to use the Blue environment.

## 6. Prepare the Green Environment

After the Green environment is created:

1. Verify that the Green database is available.
2. Verify that database replication is working.
3. Check the required database objects and data.
4. Test the application/database connectivity.
5. Verify that the Green environment is ready for switchover.

## 7. Test the Green Environment

Before performing the switchover, the Green environment should be tested.

The following areas can be validated:

* Database availability
* Database connectivity
* Required database data
* Application connectivity
* WordPress functionality
* Application health

The purpose of testing is to identify problems before changing the production database environment.

## 8. Blue to Green Switchover

After successful testing, the environment can be switched from Blue to Green.

The high-level flow is:

```text
Blue RDS
   ↓
Asynchronous Replication
   ↓
Green RDS
   ↓
Testing
   ↓
Switchover
   ↓
Green becomes Primary
```

After the switchover, the application uses the Green environment as the primary database environment.

## 9. Post-Switchover Validation

After the switchover:

1. Open the WordPress application.
2. Verify that the website is accessible.
3. Test WordPress functionality.
4. Verify database connectivity.
5. Check that application data is available.
6. Verify the application through the Application Load Balancer.

Application flow:

```text
User
 ↓
Route 53
 ↓
Application Load Balancer
 ↓
Target Group
 ↓
WordPress EC2
 ↓
Green RDS
```

## 10. RDS Blue/Green Deployment Flow

```text
                Current Environment
                       BLUE
                        │
                        │
             Asynchronous Replication
                        │
                        ↓
                       GREEN
                New Database Environment
                        │
                        ↓
                     Testing
                        │
                        ↓
                   Switchover
                        │
                        ↓
                GREEN becomes Primary
```

## 11. What I Learned

Through this project, I learned:

* What RDS Blue/Green Deployment is.
* Difference between Blue and Green environments.
* How a separate Green environment is used for testing.
* The concept of asynchronous database replication.
* How to validate the Green environment before switchover.
* How Blue-to-Green switchover works.
* How to validate the application after database switchover.
* How database deployment can be separated from the current application environment.

## 12. Result

The RDS Blue/Green deployment architecture was configured to provide a separate Green database environment.

The Green environment can be tested before performing the Blue-to-Green switchover, reducing the risk of directly making changes to the current database environment.

## 13. Project Flow

The complete project flow is:

```text
WordPress EC2
      ↓
Amazon RDS Blue
      ↓
Asynchronous Replication
      ↓
Amazon RDS Green
      ↓
Testing
      ↓
Blue → Green Switchover
      ↓
Green becomes Primary
```

> Note: The exact RDS engine versions, instance classes, subnet configuration, replication settings, and other AWS console values should be documented from the actual AWS environment used in this project. They are not specified in the original project notes.
