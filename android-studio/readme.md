## Wireless Pair Device 
- If you cant connect wireless device to android with android studio QR code or pair code, then follow below method
- Method One with adb command line
  - Install Adb tools
  - Go to Phone Developer Setting -> Wireless Debugging
  - click paire with code & you will see ip address:port and code
  - open temrinal in window : adb pair 192.168.1.5:44809
  - after successfully likh ke ayega
  - Go to Phone Developer Setting -> Wireless Debugging & you will see ip  address & port on screen 
  - terminal window : adb connect ip:port 

## Error 
Q1. java.lang.IllegalStateException: Could not find method giveSMSPermission(View) in a parent or ancestor Context for android:onClick attribute defined on view class com.google.android.material.button.MaterialButton with id 'login'
- **Solution :** private void giveSMSPermission()  to public void giveSMSPermission(View givePermissionButton)  

Q2. Recommended action: Update this project's version of the Android Gradle plugin to one that supports 34, then update this project to use compileSdkVerion of at least 34.
- **Solution :** build.gradile : compileSdk 33 to 34 & deafultConfig.targetSDK 33 to 342

    

## Do you want to install Haxm in Android Studio ?
### Follow below step carefully
- if you have  already installed haxm manualy, first uninstall, can be found namely  - "Intel Hardware Access..." or "haxm_xv_xv"
- Hyper Must Be Disabled in Your Laptop/Computer for check verify : 
    - Run the command in terminal ``
        systeminfo
      ``
    - if not found hyper-requiremenet
    - Open terminal with admin power run cmd : ``bcdedit /set hypervisorlaunchtype off`` msg : completed successfully
  Now hyper is disabled, restart the laptop
- If virtualization is disabled in the BIOS, you need to enable it
  - veriy  open terminal run cmd : systeminfo | findstr /i "virtualization"   , msg : Virtualization is enabled in framework : yes

- android studio and install haxm if it will give you something error, dont click finished button copy the path('C:\Users\Admin\AppData\Local\Android\Sdk\extras\intel') got whereas installed haxm and then manual install haxm, now come to android studio it will show you haxm is installed successfully :)

- if You still could not installed haxm, check your laptop or system supported or not for haxm , if supported, ping me, I will help you to for installation haxm through remote andesk :)
  -  Video Link : <a href="link">somethig</a> 
