# Firebase
- firebase is backend service, thats help to connect direclty to frontend,  which is made  by google
- Firebase is a ready-made backend from Google that lets you build full apps without managing servers or databases.
## Firebase History
- 2011 → Firebase start (sirf realtime database)
- 2014 → Google ne kharida
- 2016 onward → Full backend platform (jo aaj hum use karte hain)

## Firebase Rich Features 
- Login Authentiction 
- Realtime database
- Automatic Scalling 
- Push Notification
- Free Tier with limitation and Pay as you scale
- Web Hosting
- Analytics
- Storage 
- Firestore Database : collection type

## When You Dont Need to Use Firebase
- Highly customized database queries
- Very large enterprise backend
- Heavy financial transactions (banking-level systems)
- Complex Server Side Business Logic

## Why Choose Firebase 
- Corss Platform Support : Android, Apple, Window etc.
- Automatic Large Traffic Hanlding
- Easy Learn & No Backend Code Required
- Data Secured & Automatic Backup By Google
- Fast Development
- Offline Support : app work without internet
- Regular Updates & Long Term Support By Google
  
## Firebase Topic 
1. Realtime Database
2. Firestore Database
3. Web Hosting
4. Push Notification
5. Authentication

## Firebase Realtime Database
### Introduction
- Send update to all connected device onInsert, onUpdate, onDelete in client side
- Presence : client online or offline status support
- offline support for Apple and Android clients, its save on localStorage and sync when net comes
- Store Data as Json Tree
  
### Free Vs Paid
- Simultaneous Connections   : 100 in Free & 2 Lakh upto per database, so if you need more, then use multiple database
- GB Store  : 1GB/month in free after 5 doller/5GB per month
- 10GB/month Downloads in free and after pay as go
- Set Budget Alert if use paid 

## Reduce Cost in Paid Plan
- add indexing querying
- add cache in application level
  
### Limitation
- Insert/Write Operation :  1000 writes/seconds  & size of 256 MB from the REST API; 16 MB from the SDKs & 64 MB/minute with all cconnection
- Read Operation : 1 Lakh/seconds and size 256 mb , if more than mb, then use pagination, query etc.
- Maximum Deepth Child Node : 32 Levels from root
  ```bash
  students
  └── 101
       └── subjects
            └── math
                 └── marks : 95
  // this is 5 depth level node 
  ```
- Length of Key : 768 Bytes with UTF-8 encoded
- Maximum size of a string : 10mb
- Deep queries with limited sorting and filtering features.
- Performance of certain queries degrades as your dataset grows.

### Operation
###
