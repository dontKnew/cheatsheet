## 📌 Smali Kya Hai?
**Smali** Android ka **assembly-level language** hai jo **DEX bytecode** ko human-readable banata hai. Mostly **Android APK reverse engineering** me use hota hai.
## 🧱 Basic Class Structure
```smali
.class public Lcom/example/app/MainActivity;
.super Landroid/app/Activity;
```

---
## 🔧 Method Declaration
```smali
.method public onCreate(Landroid/os/Bundle;)V
    .locals 1
    return-void
.end method
```

### Access Modifiers

* `public`
* `private`
* `protected`
* `static`
* `final`

---

## 📦 Registers

* `v0, v1, v2` → **local registers**
* `p0, p1` → **method parameters**
* `p0` → usually **this**

```smali
.locals 2
```

---

## 🔢 Data Types

| Type                 | Meaning   |
| -------------------- | --------- |
| `I`                  | int       |
| `Z`                  | boolean   |
| `V`                  | void      |
| `Ljava/lang/String;` | String    |
| `Lpkg/Class;`        | Object    |
| `[I`                 | int array |

---

## ✏️ Constant Values

```smali
const/4 v0, 0x1
const-string v1, "Hello"
```

---

## 🔄 Method Call

```smali
invoke-virtual {v0}, Ljava/lang/String;->length()I
move-result v1
```

---

## 🏗 Object Create

```smali
new-instance v0, Ljava/lang/String;
invoke-direct {v0}, Ljava/lang/String;-><init>()V
```

---

## 🔁 If / Condition

```smali
if-eq v0, v1, :label_true
```

### Conditions

* `if-eq`  ==
* `if-ne`  !=
* `if-lt`  <
* `if-gt`  >
* `if-le`  <=
* `if-ge`  >=

---

## 🔂 Goto / Loop

```smali
:loop
goto :loop
```

---

## 📤 Return Types

```smali
return-void
return v0
```

---

## 📜 Fields

```smali
.field public static isPremium:Z
```

---

## 🛠 Common Modding Tricks

### Boolean true force karna

```smali
const/4 v0, 0x1
return v0
```

### Ads remove logic

```smali
return-void
```

---

## 🧰 Useful Tools

* **apktool**
* **jadx**
* **smali / baksmali**
* **Android Studio**

---

## ⚠️ Tips

* Register limit ka dhyaan rakho
* `move-result` hamesha `invoke-*` ke baad
* Wrong register = **crash**

---

Agar tum chaho to main:

* 🔐 **License bypass example**
* 💰 **In-app purchase patch**
* 🧪 **Real app smali sample**
* 📄 **PDF cheatsheet**

bhi bana sakta hoon 👍
Bas batao next kya chahiye?
