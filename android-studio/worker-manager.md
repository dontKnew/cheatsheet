# Table of Contents
1. [WorkManager Introduction](#workmanager-introduction)
2. [Types of Work](#types-of-work)
3. [Dependencies](#dependencies)
4. [Define the Worker](#define-the-worker)
5. [Result Types](#result-types)
6. [Schedule One-Time Work](#schedule-one-time-work)
7. [Start the Work](#start-the-work)
8. [Periodic Work](#periodic-work)
9. [Work Constraints](#work-constraints)
10. [Passing Data to Worker](#passing-data-to-worker)
11. [Cancel Work](#cancel-work)

# WorkManager Introduction

WorkManager is used to run **background tasks reliably** in Android.
It ensures tasks run even if:
* App is closed
* App is killed
* Device restarts

Common use cases:
* Upload files
* Sync data
* Backup logs
* Periodic API calls

---

# Types of Work
### 1. Immediate Work
* Runs immediately
* Executes as soon as possible

Example:
* Upload image after click
---

### 2. Long Running Work

* Takes longer time to complete

Example:

* Large file upload
* Video processing

---

### 3. Deferrable Work

* Runs later or periodically

Example:

* Sync data every few minutes
* Clean cache

---

# Dependencies

```kotlin
val work_version = "2.11.1"

// Java
implementation("androidx.work:work-runtime:$work_version")

// Kotlin + Coroutines
implementation("androidx.work:work-runtime-ktx:$work_version")

// RxJava support
implementation("androidx.work:work-rxjava2:$work_version")

// Testing
androidTestImplementation("androidx.work:work-testing:$work_version")

// Multiprocess support
implementation("androidx.work:work-multiprocess:$work_version")
```

Usually this is enough:

```kotlin
implementation("androidx.work:work-runtime-ktx:2.11.1")
```

---

# Define the Worker

Worker class contains the **background task logic**.

```java
public class UploadWorker extends Worker {

   public UploadWorker(
       @NonNull Context context,
       @NonNull WorkerParameters params) {
       super(context, params);
   }

   @Override
   public Result doWork() {

     uploadImages();

     return Result.success();
   }
}
```

`doWork()` method runs in background.

---

# Result Types

Worker must return one result.

| Result           | Meaning        |
| ---------------- | -------------- |
| Result.success() | Task completed |
| Result.failure() | Task failed    |
| Result.retry()   | Retry again    |

Example:

```java
return Result.retry();
```

---

# Schedule One-Time Work

Run task **only once**.

### Option 1

```java
WorkRequest myWorkRequest =
        OneTimeWorkRequest.from(MyWork.class);
```

---

### Option 2 (With configuration)

```java
WorkRequest uploadWorkRequest =
        new OneTimeWorkRequest.Builder(MyWork.class)
        .build();
```

---

# Start the Work

Enqueue work using WorkManager.

```java
WorkManager
        .getInstance(context)
        .enqueue(uploadWorkRequest);
```

---

# Periodic Work

Run task repeatedly.

```java
PeriodicWorkRequest periodicWork =
        new PeriodicWorkRequest.Builder(
        MyWork.class,
        15, TimeUnit.MINUTES)
        .build();
```

Start work:

```java
WorkManager.getInstance(context)
.enqueue(periodicWork);
```

Minimum interval = **15 minutes**

---

# Work Constraints

Run work only under conditions.

Example: Internet required

```java
Constraints constraints = new Constraints.Builder()
        .setRequiredNetworkType(NetworkType.CONNECTED)
        .build();
```

Use constraints:

```java
OneTimeWorkRequest request =
        new OneTimeWorkRequest.Builder(MyWork.class)
        .setConstraints(constraints)
        .build();
```

---

# Passing Data to Worker

Send data to worker.

```java
Data data = new Data.Builder()
        .putString("KEY", "value")
        .build();
```

Attach data:

```java
OneTimeWorkRequest request =
        new OneTimeWorkRequest.Builder(MyWork.class)
        .setInputData(data)
        .build();
```

Get data inside worker:

```java
String value = getInputData().getString("KEY");
```

---

# Cancel Work

Cancel running tasks.

```java
WorkManager.getInstance(context)
.cancelAllWork();
```
Or cancel specific work using ID.

If you want, I can also make a **professional Android Notes README template (best for GitHub)** like big Android repositories use. 🚀
