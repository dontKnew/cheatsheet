# React Native Overview
- React Native support both ios & android, its require macbook for ios & window for android test & debugging
- Some Codes Can Be Used in Android & IOS
- Some times you cant find library for spefici function, so you need to create custom module & write native code for both ios & android , because its different platform
- You can Write separate code for each platform 
```jsx
file.ios.jsx // for IOS SYSTEM
file.android.jsx // for android system
file.jsx // for both IOS & ANDROID
```

## Installation 
### i. React Native Cli ( Recommmend)
- Install JDK
- Install Android Studio (NDK, SDK, Emulator)
- Install Nodejs
- npx react-native init MyApp
Note : Before install check react-native requirements of version that compatible with nodejs, jdk and android studio
### ii. Expo cli (Not Recommend)
- performance low as compoare to react-native
- Its Generate Native Code For Android & IOS

## File Strucutre 
- Metro Config : its ued for Livereload , fast refresh , combine all js code into single code, support.ios, support.android file name base code
- Bable Config : used for convert js code to latest version code 
- index.js : entry point of your application, here define one component, then those component using rendering all components



## Stylish
```jsx
import { View, Text, StyleSheet } from 'react-native';
export default function App() {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Hello React Native</Text>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#fff',
  },
  title: {
    fontSize: 24,
    color: '#4A90E2',
    fontWeight: 'bold',
  },
});
```

## API CAll
```jsx
import React, { useEffect, useState } from 'react';
import { View, Text, ActivityIndicator } from 'react-native';

export default function FetchExample() {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('https://jsonplaceholder.typicode.com/posts/1')
      .then(res => res.json())
      .then(json => setData(json))
      .catch(err => console.error(err))
      .finally(() => setLoading(false));
  }, []);

  return (
    <View style={{ padding: 20 }}>
      {loading ? (
        <ActivityIndicator />
      ) : (
        <Text>{data?.title}</Text>
      )}
    </View>
  );
}
```

## Form Design
```jsx
//npm install @react-native-picker/picker for select
import React, { useState } from 'react';
import {
  View,
  TextInput,
  Button,
  Alert,
  StyleSheet,
  ScrollView,
  Text,
} from 'react-native';
import { Picker } from '@react-native-picker/picker';

export default function FullForm() {
  const [form, setForm] = useState({
    name: '',
    email: '',
    password: '',
    phone: '',
    gender: '',
    address: '',
  });

  const handleChange = (key, value) => {
    setForm(prev => ({ ...prev, [key]: value }));
  };

  const handleSubmit = () => {
    const { name, email, phone, gender, address, password } = form;
    Alert.alert('Form Submitted', `
      Name: ${name}
      Email: ${email}
      Phone: ${phone}
      Gender: ${gender}
      Address: ${address}
      Password: ${password}
    `);
  };

  return (
    <ScrollView contentContainerStyle={styles.container}>
      <TextInput
        placeholder="Name"
        value={form.name}
        onChangeText={val => handleChange('name', val)}
        style={styles.input}
      />
      <TextInput
        placeholder="Email"
        value={form.email}
        keyboardType="email-address"
        onChangeText={val => handleChange('email', val)}
        style={styles.input}
      />
      <TextInput
        placeholder="Password"
        value={form.password}
        onChangeText={val => handleChange('password', val)}
        secureTextEntry
        style={styles.input}
      />
      <TextInput
        placeholder="Phone"
        value={form.phone}
        onChangeText={val => handleChange('phone', val)}
        keyboardType="phone-pad"
        style={styles.input}
      />

      <Text style={styles.label}>Gender:</Text>
      <View style={styles.pickerContainer}>
        <Picker
          selectedValue={form.gender}
          onValueChange={val => handleChange('gender', val)}
        >
          <Picker.Item label="Select Gender" value="" />
          <Picker.Item label="Male" value="male" />
          <Picker.Item label="Female" value="female" />
          <Picker.Item label="Other" value="other" />
        </Picker>
      </View>

      <TextInput
        placeholder="Address"
        value={form.address}
        onChangeText={val => handleChange('address', val)}
        multiline
        numberOfLines={4}
        style={[styles.input, { height: 100, textAlignVertical: 'top' }]}
      />

      <Button title="Submit" onPress={handleSubmit} />
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: {
    padding: 20,
    gap: 10,
  },
  input: {
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 6,
    padding: 12,
  },
  pickerContainer: {
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 6,
  },
  label: {
    fontWeight: 'bold',
    marginBottom: 4,
  },
});
```

## FlatList
- Its used for render the dynamically data
- Many More Porperties for FlatList Like keyExtractoor 
- Use a FlatList for Performance
```jsx
import React from 'react';
import { FlatList, Text, View } from 'react-native';

const DATA = [
  { id: '1', title: 'Apple' },
  { id: '2', title: 'Banana' },
  { id: '3', title: 'Cherry' },
];

const App = () => {
  const renderItem = ({ item }) => (
    <View style={{ padding: 10 }}>
      <Text>{item.title}</Text>
    </View>
  );

  return (
    <FlatList
      data={DATA}
      keyExtractor={(item) => item.id}
      renderItem={renderItem}
    />
  );
};
export default App;
```
## Navigation
- Its mean redirect one page to another page by click button or add links
- Installation 
```bash
npm install @react-navigation/native
npx expo install react-native-screens react-native-safe-area-context
npm install react-native-gesture-handler react-native-reanimated
npm install @react-navigation/native-stack @react-navigation/bottom-tabs @react-navigation/drawer
```
- There are three type of navigation
i. Stack Navigation: Used for moving between screens like a stack (e.g., Login → Home → Profile).
```jsx
import { createNativeStackNavigator } from '@react-navigation/native-stack';

const Stack = createNativeStackNavigator();

function App() {
  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName="Home">
        <Stack.Screen name="Home" component={HomeScreen} />
        <Stack.Screen name="Profile" component={ProfileScreen} />
      </Stack.Navigator>
    </NavigationContainer>
  );
}
```
ii. Tab Navigation : Used for switching between major app sections , used for bottom tab or top tab
```jsx
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';

const Tab = createBottomTabNavigator();

function App() {
  return (
    <NavigationContainer>
      <Tab.Navigator>
        <Tab.Screen name="Dashboard" component={DashboardScreen} />
        <Tab.Screen name="Settings" component={SettingsScreen} />
      </Tab.Navigator>
    </NavigationContainer>
  );
}
```
iii.  Drawer Navigation (Side Menu)
```jsx
import { createDrawerNavigator } from '@react-navigation/drawer';

const Drawer = createDrawerNavigator();

function App() {
  return (
    <NavigationContainer>
      <Drawer.Navigator initialRouteName="Home">
        <Drawer.Screen name="Home" component={HomeScreen} />
        <Drawer.Screen name="Settings" component={SettingsScreen} />
      </Drawer.Navigator>
    </NavigationContainer>
  );
}
```




## Events
```jsx
// 1. `onPress` (Single Tap)
<TouchableOpacity onPress={() => console.log('Pressed')}>
  <Text>Tap Me</Text>
</TouchableOpacity>

// 2. `onLongPress` (Long Touch)
<TouchableOpacity onLongPress={() => console.log('Long Pressed')}>
  <Text>Hold Me</Text>
</TouchableOpacity>

// 3. `onChangeText` (Text Input Typing)
<TextInput
  placeholder="Type here"
  onChangeText={(text) => console.log('Typed:', text)} />

// 4. `onSubmitEditing` (Enter Key / Done)
<TextInput
  placeholder="Submit on Enter"
  onSubmitEditing={(e) => console.log('Submitted:', e.nativeEvent.text)}
/>

// 5. `onFocus` and `onBlur` (Input Focus Events)
<TextInput
  onFocus={() => console.log('Input Focused')}
  onBlur={() => console.log('Input Blurred')}
/>

// 6. `onScroll` (Scroll Event in ScrollView)
<ScrollView
  onScroll={(e) => console.log('Scroll Y:', e.nativeEvent.contentOffset.y)}
  scrollEventThrottle={16}
>
  <Text>Scroll Me</Text>
</ScrollView>

// 7. `onLayout` (Layout Measurement)
<View onLayout={(e) => console.log('Layout:', e.nativeEvent.layout)}>
  <Text>Measured View</Text>
</View>

// 8. Custom Double Tap (Manual Detection)
<TouchableOpacity onPress={handleDoubleTap}>
  <Text>Double Tap Me</Text>
</TouchableOpacity>

// 9. `onEndReached` (FlatList Scroll to Bottom)
//Use a FlatList for Performance
<FlatList
  data={[{ key: 'Item 1' }, { key: 'Item 2' }]}
  renderItem={({ item }) => <Text>{item.key}</Text>}
  onEndReached={() => console.log('Reached end')}
  onEndReachedThreshold={0.5}
/>
```

## Life Cycle Method of React 
1. Mounting (Start)
2. Update if Any Changes 
3. unMount (Destory)

## Session & Storage
- npm install react-native-encrypted-storage  (React Native 0.60+)
- its like local storage
- Delete All Data when app is uninstall or deleted
- in IOS Limitation of Storage..
```jsx
import EncryptedStorage from 'react-native-encrypted-storage';
async function storeUserSession() {
    try {
      // 1. Store
        await EncryptedStorage.setItem(
            "user_session",
            JSON.stringify({
                age : 21,
                token : "ACCESS_TOKEN",
                username : "emeraldsanto",
                languages : ["fr", "en", "de"]
            })
        );
        // 2. Get
          const session = await EncryptedStorage.getItem("user_session");  
          if (session !== undefined) {
              // Congrats! You've just retrieved your first value!
          }
        // 3. Remove 
        await EncryptedStorage.removeItem("user_session");

        // 4. Clean Storage
        await EncryptedStorage.clear();
    } catch (error) {
      //IOS :  Take the removeItem example, an error can occur here
    }
}
```

## Redux
- whenever we need to use one variable/state to global in application
- Its Update realtime variable state & update UI 
- Example
```jsx
//npm install @reduxjs/toolkit react-redux 
//1. authSlice.js :  Create authSlice.js
import { createSlice } from '@reduxjs/toolkit';

const authSlice = createSlice({
  name: 'auth',
  initialState: {
    isLoggedIn: false,
    user: null,
  },
  reducers: {
    login: (state, action) => {
      state.isLoggedIn = true;
      state.user = action.payload; // e.g., { name: "John" }
    },
    logout: state => {
      state.isLoggedIn = false;
      state.user = null;
    },
  },
});

export const { login, logout } = authSlice.actions;
export default authSlice.reducer;

// 2. store.js : Setup Redux store
import { configureStore } from '@reduxjs/toolkit';
import authReducer from './authSlice';

export const store = configureStore({
  reducer: {
    auth: authReducer,
  },
});


//3. App.js
import React from 'react';
import { Provider } from 'react-redux';
import { store } from './store';
import Home from './Home';

export default function App() {
  return (
    <Provider store={store}>
      <Home />
    </Provider>
  );
}

//4. Home.js :  Use Redux in a component
import React from 'react';
import { View, Text, Button } from 'react-native';
import { useDispatch, useSelector } from 'react-redux';
import { login, logout } from './authSlice';

export default function Home() {
  const { isLoggedIn, user } = useSelector(state => state.auth);
  const dispatch = useDispatch();

  return (
    <View style={{ padding: 40 }}>
      {isLoggedIn ? (
        <>
          <Text style={{ fontSize: 24 }}>Welcome, {user.name}!</Text>
          <Button title="Logout" onPress={() => dispatch(logout())} />
        </>
      ) : (
        <>
          <Text style={{ fontSize: 24 }}>Please log in</Text>
          <Button
            title="Login as John"
            onPress={() => dispatch(login({ name: 'John' }))}
          />
        </>
      )}
    </View>
  );
}
```
- For persist data even page reload ? You need to async storage ,, not encrypted above storage
```jsx
//npm install redux-persist @react-native-async-storage/async-storage
// 1. Setup store.js with persistReducer
// store.js
import { configureStore } from '@reduxjs/toolkit';
import { persistReducer, persistStore } from 'redux-persist';
import AsyncStorage from '@react-native-async-storage/async-storage';
import authReducer from './authSlice';
import { combineReducers } from 'redux';

const persistConfig = {
  key: 'root',
  storage: AsyncStorage,
};

const rootReducer = combineReducers({
  auth: authReducer,
});

const persistedReducer = persistReducer(persistConfig, rootReducer);

export const store = configureStore({
  reducer: persistedReducer,
});

export const persistor = persistStore(store);

// 2. Wrap your app with PersistGate
// App.js
import React from 'react';
import { Provider } from 'react-redux';
import { store, persistor } from './store';
import { PersistGate } from 'redux-persist/integration/react';
import Home from './Home';

export default function App() {
  return (
    <Provider store={store}>
      <PersistGate loading={null} persistor={persistor}>
        <Home />
      </PersistGate>
    </Provider>
  );
}

//3. Your authSlice.js stays the same as previous without async storage

/*
🔐 User logs in → state is saved in AsyncStorage
🔁 App restarts → state is restored
🚫 User logs out → Redux + storage is cleared
*/
```

## Permission 
- npm install react-native-permissions
- npx pod-install # for ios
- Each Permission for ios & android dfferent requiremment, like runtime permission, on reqeust permission, etc. please check requirements, before take permission and limitation
- Process
  i. add permission code at  android/app/src/main/AndroidManifest.xml 
  ```xml
  <uses-permission android:name="android.permission.CAMERA" />
  <uses-permission android:name="android.permission.ACCESS_FINE_LOCATION" />
  <uses-permission android:name="android.permission.READ_EXTERNAL_STORAGE" />
  ```
  ii. ios/YourApp/Info.plist
  ```xml
  <key>NSCameraUsageDescription</key>
  <string>We need access to your camera to take photos</string>
  ```
  iii. Request Permission 
```jsx
const permission = Platform.select({
    android: PERMISSIONS.ANDROID.CAMERA,
    ios: PERMISSIONS.IOS.CAMERA,
});

// Check Permission Before Request
import { check, RESULTS } from 'react-native-permissions';
const checkPermission = async (permission) => {
  const status = await check(permission);

  switch (status) {
    case RESULTS.GRANTED:
      console.log('Permission granted');
      break;
    case RESULTS.DENIED:
      requestCameraPermission(); // Calling Permmission
      console.log('Permission denied, can ask again');
      break;
    case RESULTS.BLOCKED:
      console.log('Permission permanently blocked');
      break;
  }
};
// Request Permission
import { request, PERMISSIONS, RESULTS } from 'react-native-permissions';
import { Platform } from 'react-native';

const requestCameraPermission = async () => {

  const result = await request(permission);

  if (result === RESULTS.GRANTED) {
    console.log('Camera permission granted');
  } else {
    console.warn('Camera permission denied or blocked');
  }
};

```

## React Native Library and Packages
- Go to https://reactnative.directory/ or search in google to check packages that can use in project
- there many package like react-native-sms, react-native-async-storage, react-native-firebase

## FCM setup 
- create project, database then download google-service.json file firebase project setting and create app
- Follow app proceedure to add dependency in android app
- Add Permission in AndroidManifest.xml file
```xml
<uses-permission android:name="android.permission.INTERNET"/>
<uses-permission android:name="android.permission.RECEIVE_BOOT_COMPLETED"/>
<uses-permission android:name="android.permission.POST_NOTIFICATIONS"/> <!-- Android 13+ -->
```
- npm install @react-native-firebase/app @react-native-firebase/messaging
- npx pod-install  # for iOS
```jsx
// Request Permmission
import messaging from '@react-native-firebase/messaging';
import { Platform, PermissionsAndroid } from 'react-native';

// Android 13+ requires explicit permission
const requestUserPermission = async () => {
  const authStatus = await messaging().requestPermission();
  const enabled =
    authStatus === messaging.AuthorizationStatus.AUTHORIZED ||
    authStatus === messaging.AuthorizationStatus.PROVISIONAL;

  if (enabled) {
    console.log('FCM Permission status:', authStatus);
  }

  if (Platform.OS === 'android' && Platform.Version >= 33) {
    const granted = await PermissionsAndroid.request(
      PermissionsAndroid.PERMISSIONS.POST_NOTIFICATIONS
    );
    console.log('Android POST_NOTIFICATIONS granted:', granted);
  }
};

// Get FCM Token
const getToken = async () => {
  const token = await messaging().getToken();
  console.log('FCM Token:', token);
};

//// Foreground : when user open the app & notification come, then you need to show in UI mannnualy
useEffect(() => {
  const unsubscribe = messaging().onMessage(async remoteMessage => {
    Alert.alert('New FCM Message', JSON.stringify(remoteMessage.notification));
  });
  return unsubscribe;
}, []);

//Background / Quit state
import messaging from '@react-native-firebase/messaging';

messaging().setBackgroundMessageHandler(async remoteMessage => {
  console.log('FCM Background message:', remoteMessage);
});

```
- Go to Firebase Console → Cloud Messaging, add fcm token, sendnotification
- Local Notification Message
```jsx
//npm install @notifee/react-native
import notifee from '@notifee/react-native';

await notifee.displayNotification({
  title: 'Hello',
  body: 'This is a local notification',
});
```


## Built for Fast Development
- npm run android -- active-arch-only : its remove other cpu thats not used
- org.gradle.configuration-cache = true : its add cache for fast gradile,, in andorid/gradile.properties
- Create Custom Module with own andorid studio code or Create Packages
- Go to Here & Learn : https://reactnative.dev/docs/turbo-native-modules-introduction






