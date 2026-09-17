# Route 53 and ACM Configuration

## 1. Overview

After configuring the WordPress application and Application Load Balancer, I configured **Amazon Route 53** for DNS management and **AWS Certificate Manager (ACM)** for HTTPS.

The purpose of this configuration is to access the WordPress application using a domain name instead of directly using the ALB DNS name and to secure the application using HTTPS.

## 2. Route 53 Configuration

### Step 1: Open Route 53

1. Open the **AWS Management Console**.
2. Search for **Route 53**.
3. Open the Route 53 service.
4. Go to **Hosted zones**.

### Step 2: Create Hosted Zone

1. Click **Create hosted zone**.
2. Enter the domain name.

Example:

```text
example.com
```

3. Select:

```text
Type: Public hosted zone
```

4. Click **Create hosted zone**.

### Step 3: Configure DNS Record

Create a DNS record to route the domain to the Application Load Balancer.

1. Open the hosted zone.
2. Click **Create record**.
3. Enter the required record name.

Example:

```text
www
```

4. Select the appropriate record type.
5. Configure the record to point to the **Application Load Balancer**.
6. Save the record.

### Route 53 Flow

```text
User
  ↓
Domain Name
  ↓
Amazon Route 53
  ↓
Application Load Balancer
  ↓
Target Group
  ↓
WordPress EC2
  ↓
Amazon RDS MySQL
```

## 3. What I Learned from Route 53

Through this configuration, I learned:

* What DNS is.
* How Amazon Route 53 manages DNS records.
* How to create a Public Hosted Zone.
* How to create DNS records.
* How a domain can point to an Application Load Balancer.
* How users access an AWS-hosted application using a domain name.

---

# 4. AWS Certificate Manager (ACM)

AWS Certificate Manager is used to obtain and manage SSL/TLS certificates for securing the application with HTTPS.

## 5. Request an ACM Certificate

1. Open the **AWS Management Console**.
2. Search for **Certificate Manager**.
3. Open **AWS Certificate Manager (ACM)**.
4. Click **Request**.
5. Select:

```text
Request a public certificate
```

6. Enter the domain name.

Example:

```text
example.com
```

If required, add:

```text
*.example.com
```

7. Select **DNS validation**.
8. Click **Request**.

## 6. Validate the Certificate

After requesting the certificate:

1. Open the certificate details.
2. Check the **Domain validation** section.
3. Copy the required DNS validation record.
4. Add the validation record to Route 53 if using Route 53 DNS validation.
5. Wait until the certificate status becomes:

```text
Issued
```

## 7. Configure HTTPS on Application Load Balancer

After the ACM certificate is issued:

1. Go to **EC2 → Load Balancers**.
2. Select the WordPress Application Load Balancer.
3. Open the **Listeners** section.
4. Add/configure an HTTPS listener.
5. Select:

```text
Protocol: HTTPS
Port: 443
```

6. Select the ACM certificate.
7. Configure the listener to forward traffic to the WordPress Target Group.
8. Save the listener configuration.

## 8. Final HTTPS Flow

```text
User
  ↓
https://example.com
  ↓
Route 53
  ↓
Application Load Balancer
  ↓
HTTPS : 443
  ↓
ACM SSL/TLS Certificate
  ↓
Target Group
  ↓
WordPress EC2
  ↓
Amazon RDS MySQL
```

## 9. HTTP to HTTPS

If HTTP to HTTPS redirection is configured on the Application Load Balancer, requests received on port `80` can be redirected to HTTPS on port `443`.

```text
HTTP : 80
    ↓
Redirect
    ↓
HTTPS : 443
```

## 10. Test HTTPS

Open the configured domain in a browser:

```text
https://example.com
```

Verify that:

* The WordPress website opens.
* HTTPS is enabled.
* The browser shows a secure connection.
* The domain resolves to the application through Route 53.
* The ALB forwards the request to a healthy target.

## 11. What I Learned from ACM

Through this configuration, I learned:

* What SSL/TLS certificates are.
* How to request a public certificate using ACM.
* How DNS validation works.
* How ACM certificates are used with an Application Load Balancer.
* How HTTPS works on port 443.
* How to configure secure access to a web application.
* How Route 53 and ACM work together with an ALB.

## 12. Result

The domain was configured using **Amazon Route 53**, and the application was secured using an **AWS Certificate Manager SSL/TLS certificate** with the Application Load Balancer.

The final application access flow is:

```text
Domain
  ↓
Route 53
  ↓
ALB
  ↓
ACM / HTTPS
  ↓
Target Group
  ↓
WordPress EC2
  ↓
RDS MySQL
```
