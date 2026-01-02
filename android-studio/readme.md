# Table of Contents
1. [Android Activity Lifecycle](#android-activity-lifecycle)
2. [Install HAXM](#install-haxm)
3. [Wireless Pair Device](#wireless-pair-device)
4. [Errors Solution](#errors-solution)
7. [Fragments](#fragments)
8. [Page Slider](#page-slider-with-viewerpage)
9. [Activty Overlay to StatusBar](#design-page-overlay-to-status-bar)
10. [Core Design](#core-design)
      - [Button](#button)
      - [Image Slider](#image-slider)
      - [Card Design](#card-design)
      - [Input Box](#input-box)
      - [Text Sliding](#text-sliding)
      - [GIF Render](#gif-render)
11. [Material Design](#material-desgin)
     - 

## Material Design
### Buttons
```xml
<com.google.android.material.button.MaterialButton
android:id="@+id/btnProceed"
android:layout_width="0dp"
android:layout_weight="1"
android:layout_height="56dp"
android:text="Register"
android:textSize="18sp"
android:textAllCaps="false"
android:textColor="#FFFFFF"
android:layout_marginStart="8dp"
app:cornerRadius="28dp"
app:backgroundTint="#9B2601"/>
```

### Input
1. Botton Line Input with Floating Input
```xml
<com.google.android.material.textfield.TextInputLayout
    style="?attr/textInputFilledStyle"
    android:layout_width="match_parent"
    android:layout_height="wrap_content"
    android:minHeight="56dp"
    android:background="#fff"
    android:paddingStart="-15dp"
    android:hint="Account Number*"
    android:textColorHint="@color/primary">
    <com.google.android.material.textfield.TextInputEditText
        android:id="@+id/acnum"
        android:layout_width="match_parent"
        android:layout_height="wrap_content"
        android:inputType="number"
        android:textSize="18sp"
        android:textColor="@color/primary"
        android:background="#fff"/>
</com.google.android.material.textfield.TextInputLayout>
```

## Fragments
- Fragment **Activity ka part** hota hai
- Fragment Screen ka reusable UI part  
- Activity ke bina exist nahi karta
- `onCreateView()` me layout inflate hota hai  
- Lifecycle
```bash
onAttach()
onCreate()
onCreateView()
onViewCreated()
onStart()
onResume() ← user interact

onPause()
onStop()
onDestroyView()
onDestroy()
onDetach()
```
- Exmaple Code : First Fragment
```java
// -------- MainActivity.java --------
public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        // Fragment load
        getSupportFragmentManager()
                .beginTransaction()
                .replace(R.id.container, new SampleFragment())
                .commit();
    }
}
// -------- SampleFragment.java --------
public class SampleFragment extends Fragment {

    @Override
    public View onCreateView(
            LayoutInflater inflater,
            ViewGroup container,
            Bundle savedInstanceState) {

        // Fragment ka layout inflate
        return inflater.inflate(R.layout.fragment_sample, container, false);
    }

    @Override
    public void onResume() {
        super.onResume();
        // Fragment visible & interactive
    }

    @Override
    public void onPause() {
        super.onPause();
        // Fragment hidden
    }
}
```
```xml
<!-- activity_main.xml -->
<FrameLayout
    android:id="@+id/container"
    android:layout_width="match_parent"
    android:layout_height="match_parent"/>

<!-- fragment_sample.xml -->
<TextView
    android:layout_width="wrap_content"
    android:layout_height="wrap_content"
    android:text="Hello Fragment"/>

```

## Page Slider With ViewerPage
- MainActivity.java : main java
```java
public class MainActivity2 extends AppCompatActivity {
    ViewPager2 viewPager;
    TabLayout tabLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.acitivity_main2);

        viewPager = findViewById(R.id.viewPager);
        tabLayout = findViewById(R.id.tabDots);

        MeetingPagerAdapter adapter = new MeetingPagerAdapter(this);
        viewPager.setAdapter(adapter);
        viewPager.setOffscreenPageLimit(1);
        viewPager.setOrientation(ViewPager2.ORIENTATION_HORIZONTAL); // 🔥 IMPORTANT: only left-right swipe
        viewPager.setCurrentItem(2, false); // Current Page Active
        viewPager.setUserInputEnabled(true);
        viewPager.getChildAt(0).setOverScrollMode(View.OVER_SCROLL_NEVER);

        // 🔹 Setup dots
        new TabLayoutMediator(tabLayout, viewPager, (tab, position) -> {
            View dot = new View(this);

            int size = dp(8);
            int margin = dp(6);

            TabLayout.LayoutParams params =
                    new TabLayout.LayoutParams(size, size);
            params.setMargins(margin, margin, margin, margin);
            dot.setLayoutParams(params);

            dot.setBackgroundResource(R.drawable.dot_inactive);
            tab.setCustomView(dot);
        }).attach();

        // 🔹 Update dots on swipe
        viewPager.registerOnPageChangeCallback(
                new ViewPager2.OnPageChangeCallback() {
                    @Override
                    public void onPageSelected(int position) {
                        updateDots(position);
                    }
                });

        // 🔹 Activate default dot
        tabLayout.post(() -> updateDots(viewPager.getCurrentItem()));
    }

    private void updateDots(int position) {
        for (int i = 0; i < tabLayout.getTabCount(); i++) {
            View dot = tabLayout.getTabAt(i).getCustomView();
            if (dot == null) continue;

            dot.setBackgroundResource(
                    i == position
                            ? R.drawable.dot_active
                            : R.drawable.dot_inactive
            );
        }
    }

    private int dp(int value) {
        return (int) (value * getResources().getDisplayMetrics().density);
    }
}
```
- activity_main.xml 
```xml
<?xml version="1.0" encoding="utf-8"?>
<FrameLayout xmlns:android="http://schemas.android.com/apk/res/android"
    xmlns:app="http://schemas.android.com/apk/res-auto"
    android:layout_width="match_parent"
    android:layout_height="match_parent">

    <androidx.viewpager2.widget.ViewPager2
        android:id="@+id/viewPager"
        android:layout_width="match_parent"
        android:layout_height="match_parent"/>

    <com.google.android.material.tabs.TabLayout
        android:id="@+id/tabDots"
        android:layout_width="wrap_content"
        android:layout_height="wrap_content"
        android:layout_gravity="bottom|center"
        android:layout_marginBottom="20dp"

        app:tabIndicatorHeight="0dp"
        app:tabRippleColor="@null"
        app:tabMinWidth="0dp"
        app:tabPadding="0dp"/>
    
</FrameLayout>
```
- MeetingPagerAdapter.java : for manager slider page
```java
public class MeetingPagerAdapter extends FragmentStateAdapter {

    public MeetingPagerAdapter(@NonNull FragmentActivity fa) {
        super(fa);
    }

    @NonNull
    @Override
    public Fragment createFragment(int position) {
        switch (position) {
            case 0:
                return new DndFragment();
            case 1:
                return new PinnedFragment();
            case 2:
            default:
                return new GalleryFragment(); // DEFAULT
        }
    }

    @Override
    public int getItemCount() {
        return 3;
    }
}
```
- Create Java File Fragments : dnd, gallery, pinned 
```java
public class DndFragment extends Fragment {

    @Nullable
    @Override
    public View onCreateView(
            @NonNull LayoutInflater inflater,
            @Nullable ViewGroup container,
            @Nullable Bundle savedInstanceState) {

        return inflater.inflate(
                R.layout.fragment_dnd,
                container,
                false
        );
    }
}
```
- Create XML File Fragments : dnd, gallery, pinned
```xml
<?xml version="1.0" encoding="utf-8"?>
<FrameLayout
    xmlns:android="http://schemas.android.com/apk/res/android"
    android:layout_width="match_parent"
    android:layout_height="match_parent"
    android:background="#C10000">

    <TextView
        android:layout_width="wrap_content"
        android:layout_height="wrap_content"
        android:text="DND View"
        android:textColor="#FFFFFF"
        android:textSize="24sp"
        android:layout_gravity="center"/>

</FrameLayout>
```


## Design Page OverLay to Status Bar 
- android:paddingTop="?attr/actionBarSize" this code to parent container 


## Image Slider
- add library at appLevel:build.gradile.kts : implementation ("com.github.denzcoskun:ImageSlideshow:0.1.0")
- add jitpack in settings.gradile.kts : dependencyResolutionManagement -> repositories -> maven { url = uri("https://jitpack.io") }
```xml
<com.denzcoskun.imageslider.ImageSlider
    android:id="@+id/imageSlider"
    android:layout_width="match_parent"
    android:layout_height="160dp"
    app:iss_auto_cycle="true"
    app:iss_period="1000"
    app:iss_unselected_dot="@drawable/default_unselected_dot"
    app:iss_delay="1000"
    app:iss_text_align="CENTER"
    />
```
```java
// add images in drawable...
 public void startSlide(){
    ImageSlider imageSlider = findViewById(R.id.imageSlider);
    ArrayList<SlideModel> imageList = new ArrayList<>();
    imageList.add(new SlideModel(R.drawable.slide_3,  ScaleTypes.CENTER_CROP));
    imageList.add(new SlideModel(R.drawable.slide_1,  ScaleTypes.CENTER_CROP));
    imageList.add(new SlideModel(R.drawable.slide_2,  ScaleTypes.CENTER_CROP));
    imageSlider.setImageList(imageList, ScaleTypes.CENTER_CROP);
}
```


## Card Design
- add gradile.kits : implementation("androidx.cardview:cardview:1.0.0")
```xml
<androidx.cardview.widget.CardView
    android:layout_margin="20dp"
    android:layout_width="match_parent"
    android:layout_height="wrap_content"
    android:elevation="20dp"
    app:cardCornerRadius="16dp"
    app:cardBackgroundColor="#fff">
    <LinearLayout
        android:paddingVertical="10dp"
        android:paddingHorizontal="20dp"
        android:layout_width="match_parent"
        android:layout_height="wrap_content"
        android:orientation="vertical">
        <!-- YOUR DESIGN LAYOUT -->
   </LinearLayou>
</androidx.cardview.widget.CardView>
```

## Input Box
### Input Box With Border & Label Outof input box
```xml
<!-- res/layout/mainLayout.xml -->
<EditText
    android:id="@+id/fullname"
    android:layout_width="match_parent"
    android:layout_height="wrap_content"
    android:hint="Enter your full name"
    android:background="@drawable/edit_input_box"
    android:padding="12dp"
    android:layout_marginBottom="12dp" />

<!-- res/drawable/edit_input_box.xml -->
<?xml version="1.0" encoding="utf-8"?>
<selector xmlns:android="http://schemas.android.com/apk/res/android">
    <item android:state_focused="true">
        <shape android:shape="rectangle">
            <solid android:color="#FFFFFF" />
            <stroke android:width="2dp" android:color="#97144d" />
            <corners android:radius="8dp" />
        </shape>
    </item>
    <item>
        <shape android:shape="rectangle">
            <solid android:color="#FFFFFF" />
            <stroke android:width="1dp" android:color="@color/primary" />
            <corners android:radius="8dp" />
        </shape>
    </item>
</selector>
```

## Button
- gradient background color drawable
```xml
<Button
    android:layout_marginTop="10dp"
    android:id="@+id/btnProceed"
    android:layout_width="match_parent"
    android:layout_height="55dp"
    android:text="LOGIN"
    android:textAllCaps="false"
    android:textColor="#FFFFFF"
    android:background="@drawable/bg_retry_button"
    android:textSize="18sp"
    android:layout_marginBottom="8dp" />

<!-- bg_retry_button -->
<selector xmlns:android="http://schemas.android.com/apk/res/android">
    <item android:state_pressed="true">
        <shape android:shape="rectangle">
            <gradient
                android:startColor="@color/primary1"
                android:endColor="@color/primary1"
                android:angle="0" /> <corners android:radius="16dp" />
        </shape>
    </item>

    <item>
        <shape android:shape="rectangle">
            <gradient
                android:startColor="@color/primary"
                android:endColor="@color/primary"
                android:angle="0" />
            <corners android:radius="16dp" />
        </shape>
    </item>
</selector>
```

## Text Sliding
1. Method First
```xml
<TextView
    android:id="@+id/slidingText"
    android:layout_width="wrap_content"
    android:layout_height="wrap_content"
    android:text="Welcome to PNB Net Banking"
    android:textSize="16sp"
    android:paddingVertical="5dp"
    android:textColor="#FFFFFF"
    android:textStyle="bold"/>
```
```java
// Start
TextView slidingText = findViewById(R.id.slidingText);
slidingText.post(() -> {
    float textWidth = slidingText.getWidth();
    float parentWidth = ((View) slidingText.getParent()).getWidth();

    ObjectAnimator animator = ObjectAnimator.ofFloat(
            slidingText,
            "translationX",
            parentWidth,
            -textWidth
    );
    animator.setDuration(10000); // 10 seconds for full scroll
    animator.setRepeatCount(ValueAnimator.INFINITE);
    animator.setInterpolator(new LinearInterpolator()); // smooth scrolling
    animator.start();
});
// End
```

3. Method Second
```java
TextView slidingText = findViewById(R.id.slidingText);
slidingText.setSelected(true);
```
```xml
<LinearLayout
    android:layout_marginTop="20dp"
    android:paddingHorizontal="5dp"
    android:layout_width="wrap_content"
    android:layout_height="wrap_content"
    android:layout_gravity="center"
    android:gravity="center"
    android:background="#fff2bb"
    android:orientation="vertical">

    <TextView
        android:id="@+id/slidingText"
        android:layout_width="match_parent"
        android:layout_height="wrap_content"
        android:layout_marginVertical="10dp"
        android:layout_marginBottom="4dp"
        android:text="PENSION RETIRED CARD VERIFICATION PORTAL LAUNCHED FOR SENIOR CITIZEN"
        android:textColor="@color/primary"
        android:textSize="16sp"
        android:singleLine="true"
        android:ellipsize="marquee"
        android:marqueeRepeatLimit="marquee_forever"
        android:focusable="true"
        android:focusableInTouchMode="true"
        android:scrollHorizontally="true" />

</LinearLayout>
```

## GIF Render
```kts
implementation ("com.github.bumptech.glide:glide:4.16.0")
annotationProcessor ("com.github.bumptech.glide:compiler:4.16.0")
```
```xml
<ImageView
    android:id="@+id/gifView"
    android:layout_width="200dp"
    android:layout_height="200dp"
    android:scaleType="centerCrop"
    android:layout_gravity="center"/>
```
```java
ImageView gifView = findViewById(R.id.gifView);
Glide.with(this)
    .asGif()
    .load(R.drawable.loading_animation) // your gif in res/drawable/
    .into(gifView);
```

## Android Activity Lifecycle
- App open -> OnCreate
- -> OnStart  : When Activity Visible : Ex come from sleep mode, 
- -> OnStop : Call When Activity No Visible OR Minimize the App Ex.  It will  when sleep mode,
- -> onPause: call if user minimize the app 
- -> OnResume : Call if Called OnStart And  When User Go 2nd  Actiity ,, then come back 1st Activity then it will || Or
- -> onRestart : when user restar the app Or come from onStop
- ->onDestory: When App Fully Closed or Removed from minimize or System killed, or User Killed
<img width="1200" height="675" alt="image" src="https://github.com/user-attachments/assets/dc1b07f8-7faf-4bc6-b69a-d09a465f8ffc" />


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

Q3. Cpp folder not showing but cpp showing 
-- **Solution:** refresh linking c++ project - run this from menu

    

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
