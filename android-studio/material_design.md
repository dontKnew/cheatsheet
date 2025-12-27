# Material Design Suggestion

## Buttons
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

## Input
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
