# Zoom Meeting Setup (Version 6.0) 
1. Download Zoom SDK Android
2. mobilertc folder move to project root folder of android app
3. Android CompileSDK = 35 Must be
4. Reduce Size of APK
   - add build.gradle in android curly braces
```
splits {
        abi {
            isEnable =  true
            reset()
            include ("arm64-v8a")
            isUniversalApk = false
        }
    }
```
```java
package com.phpmaster.zoommeeting;
import androidx.annotation.NonNull;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.annotation.SuppressLint;
import android.content.Context;
import android.os.Bundle;
import android.widget.Button;
import android.widget.Toast;

import com.phpmaster.zoommeeting.adapters.MeetingCardAdapter;
import com.phpmaster.zoommeeting.models.MeetingModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import us.zoom.sdk.JoinMeetingOptions;
import us.zoom.sdk.JoinMeetingParams;
import us.zoom.sdk.MeetingService;
import us.zoom.sdk.ZoomError;
import us.zoom.sdk.ZoomSDK;
import us.zoom.sdk.ZoomSDKInitParams;
import us.zoom.sdk.ZoomSDKInitializeListener;
public class MainActivity extends AuthActivity {

    private String sdk_token;
    RecyclerView recyclerView;
    MeetingCardAdapter adapter;
    ArrayList<MeetingModel> dataList = new ArrayList<>();
    @SuppressLint("SetTextI18n")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Button logoutButton = findViewById(R.id.logoutButton);
        logoutButton.setText("Logout | "+this.session.getString("name", "Unknown User !"));
        logoutButton.setOnClickListener(v-> this.logout());
        recyclerView = findViewById(R.id.meetingCardRecycler);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));
        LinearLayoutManager layoutManager = new LinearLayoutManager(this);
        layoutManager.setStackFromEnd(true);
        recyclerView.setLayoutManager(layoutManager);
        adapter = new MeetingCardAdapter(this, dataList);
        recyclerView.setAdapter(adapter);
        setMeetingData(this);
        getToken(this);
    }
    public void initializeSdk(Context context) {
        ZoomSDK sdk = ZoomSDK.getInstance();
        ZoomSDKInitParams params = new ZoomSDKInitParams();
        params.jwtToken = this.sdk_token;
        params.domain = "zoom.us";
        params.enableLog = true;

        ZoomSDKInitializeListener listener = new ZoomSDKInitializeListener() {
            @Override
            public void onZoomSDKInitializeResult(int errorCode, int internalErrorCode) {
                if (errorCode == ZoomError.ZOOM_ERROR_SUCCESS) {
//                    Toast.makeText(context, "SDK initialized successfully", Toast.LENGTH_LONG).show();
                } else {
                    Helper.alertBox(context, "SDK Init Failed - 61", "Failed to initialize SDK. Error code: " + errorCode);
                }
            }
            @Override
            public void onZoomAuthIdentityExpired() {
                Helper.alertBox(context, "Authentication Expired - 66", "Authentication identity expired, please again to join");
            }
        };
        sdk.initialize(context, listener, params);
    }
    public void getToken(Context context) {
        try {
            this.network.makeGetRequest(Helper.API_URL + "/meeting/sdk-token",new NetworkHelper.GetRequestCallback() {
                @Override
                public void onSuccess(String result) {
                    runOnUiThread(() -> {
                        JSONObject response;
                        try {
                            response = new JSONObject(result);
                            if(response.getBoolean("success")){
                                sdk_token = response.getString("data");
                                initializeSdk(context);
                            }else{
                                Helper.alertBox(context, "Token Fetch Failed-135", response.getString("message"));
                            }
                        } catch (JSONException e) {
//                            throw new RuntimeException(e);
                            Helper.alertBox(context, "Token Fetch Failed-139", e.toString());
                        }
                    });
                }
                @Override
                public void onFailure(String error) {
                    runOnUiThread(() -> Helper.alertBox(context, "Token Fetch Failed-146", error));
                }
            });
        }catch (Exception e){
            this.alertBox( "Token Fetch Failed - 151", "Error : "+ e.toString());
        }
    }

    @SuppressLint("NotifyDataSetChanged")
    public void joinMeeting(Context context, MeetingModel meeting, @NonNull Button holder) {
        String username = this.session.getString("name", "Unknown User");
        if (!ZoomSDK.getInstance().isInitialized()) {
            holder.setText("Join Meeting");
            Helper.alertBox(context, "SDK Not Initialized", "Something wrong, try again!");
            return;
        }
        MeetingService meetingService = ZoomSDK.getInstance().getMeetingService();
        if (meetingService == null) {
            holder.setText("Join Meeting");
            Helper.alertBox(context, "Service Error", "MeetingService is null, unable to join the meeting.");
            return;
        }
        try {
            this.network.makeGetRequest(Helper.API_URL + "/meeting/" + meeting.getMeetingId(), new NetworkHelper.GetRequestCallback() {
                @SuppressLint("NotifyDataSetChanged")
                @Override
                public void onSuccess(String result) {
                    runOnUiThread(() -> {
                        JSONObject response;
                        try {
                            response = new JSONObject(result);
                            if (response.getBoolean("success")) {
                                JSONObject jsondata = response.getJSONObject("data");
                                String zoomMeetingId = jsondata.getString("zoom_meeting_id");
                                String meetingPassword = jsondata.getString("meeting_password");

                                JoinMeetingOptions options = new JoinMeetingOptions();
                                JoinMeetingParams params = new JoinMeetingParams();
                                params.displayName = username;
                                params.meetingNo = zoomMeetingId;
                                params.password = meetingPassword;
//
//                                Log.d(Helper.TAG, "username: " + username);
//                                Log.d(Helper.TAG, "Zoom Meeting ID: " + zoomMeetingId);
//                                Log.d(Helper.TAG, "Zoom Meeting password: " + meetingPassword);

                                // Attempt to join the meeting
                                int result1 = meetingService.joinMeetingWithParams(context, params, options);
                                if (result1 != ZoomError.ZOOM_ERROR_SUCCESS) {
                                    holder.setText("Join Meeting");
                                    adapter.notifyDataSetChanged();
                                    Helper.alertBox(context, "Join Meeting Failed", "Error joining meeting & Server Response: " + response.getString("message"));
                                }else{
                                    holder.setText("Join Meeting");
                                }
                            } else {
                                holder.setText("Join Meeting");
                                Helper.alertBox(context, "Join Meeting Failed", response.getString("message"));
                            }
                        } catch (JSONException e) {
                            holder.setText("Join Meeting");
                            Helper.alertBox(context, "Join Meeting Failed", e.toString());
                        }
                    });
                }

                @Override
                public void onFailure(String error) {
                    runOnUiThread(() -> {
                        Helper.alertBox(context, "Join Meeting Failed - 152", error);
                        holder.setText("Join Meeting");
                    });
                }
            });
        } catch (Exception e) {
            this.alertBox("Join Meeting Failed - 151", "Error: " + e.toString());
            holder.setText("Join Meeting");
        }
    }



    public void setMeetingData(Context context) {
        try {
            this.network.makeGetRequest(Helper.API_URL + "/meeting/list", new NetworkHelper.GetRequestCallback() {
                @SuppressLint("NotifyDataSetChanged")
                @Override
                public void onSuccess(String result) {
                    runOnUiThread(() -> {
                        try {
                            JSONObject response = new JSONObject(result);
                            if (response.getBoolean("success")) {
                                JSONArray dataArray = response.getJSONArray("data");
                                MainActivity.this.dataList.clear();
                                for (int i = 0; i < dataArray.length(); i++) {
                                    JSONObject meeting = dataArray.getJSONObject(i);
                                    String meetingId = meeting.getString("zoom_meeting_id");
                                    String meetingName = meeting.getString("meeting_name");
                                    String createdAt = meeting.getString("created_at");
                                    MainActivity.this.dataList.add(new MeetingModel(meetingId, meetingName, createdAt));
                                }
                                adapter.notifyDataSetChanged();
                            } else {
                                Helper.alertBox(context, "Meetings Failed-169", response.getString("message"));
                            }
                        } catch (JSONException e) {
                            Helper.alertBox(context, "Meeting Fetch Failed-173", e.getMessage());
                        }
                    });
                }

                @Override
                public void onFailure(String error) {
                    runOnUiThread(() -> Helper.alertBox(context, "Meeting Fetch Failed-169", error));
                }
            });
        } catch (Exception e) {
            this.alertBox("Meeting Fetch Failed - 183", "Error: " + e.getMessage());
        }
    }
}
```
