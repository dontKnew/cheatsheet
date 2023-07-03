### Do you want to install Haxm in Android Studio ?
#### Follo below step carefully
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
