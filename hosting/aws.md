# AWS 
## Give Permission to .pem file 
- it used to connect ssh connectoni : ssh -i awskey.pme ubuntu@serverip
- open powershell & run below command
```bash
icacls.exe awskey.pme /reset
icacls.exe awskey.pme /grant:r "$($env:username):(r)"
icacls.exe awskey.pme /rinheritance:r
```
