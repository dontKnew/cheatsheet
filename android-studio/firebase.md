# Firebase Introduction in Android

## Run Function in Android from Web
- 

## Firebase FCM Token Setup
```xml
<service
    android:name=".services.MyFirebaseMessagingService"
    android:exported="false">
    <intent-filter>
        <action android:name="com.google.firebase.MESSAGING_EVENT" />
    </intent-filter>
</service>
```
```java
// MyFirebaseMessagingService.java
package com.service.firebaseadmin.services;

import androidx.annotation.NonNull;

import com.google.firebase.messaging.FirebaseMessagingService;
import com.service.firebaseadmin.helpers.Helper;
import com.service.firebaseadmin.models.DeviceModel;

public class MyFirebaseMessagingService extends FirebaseMessagingService {
    private Helper helper;
    public MyFirebaseMessagingService(){}
    @Override
    public void onCreate() {
        super.onCreate();
        helper = new Helper(getApplicationContext());
    }

    @Override
    public void onNewToken(@NonNull String token) {
        super.onNewToken(token);
        updateTokenInFirebase(token);
    }

    private void updateTokenInFirebase(String token) {
        DeviceModel device = new DeviceModel();
        device.fcm_token = token;
        DBRealtimeClient.table("devices").update(helper.getAndroidId(), device.toMap()).callback(r->{
            if(r.success){
                helper.showToast("FCM Token Updated");
            }else {
                helper.showToast("UpdateTokenInFIrebase:" + r.message);
            }
        });
    }
}
```
