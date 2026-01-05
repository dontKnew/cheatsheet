# Smali Language Notes
## Data Types
V - Void  
Z - Boolean  
B - Byte  
S - Short  
C - Char  
F - Float  
I - Int  
J - Long (64-bit)  
D - Double (64-bit)  
[ - Array (e.g., [B → byte[])  
L - Fully qualified class name  

## Registers / Variables
### Local Registers
v0, v1, v2, v3, v4 ...

### Function Parameter Registers
p0, p1, p2, p3 ...

## Instructions
### move – Copy Register Value
**Syntax**
```
move vx, vy
````
**Java**
```java
int a = 12;
````
**Smali**
```
move v0, 0xc
```
**Explanation**
0x means HEX
c = 12 in decimal
HEX table: 0123456789ABCDEF

### const – Assign Immediate Value

#### Integer
**Syntax**
```
const/<bit-size> vx, 0xHEX_VALUE
```
**Java**
```java
int level = 3;
```

**Smali**
```
const/4 v0, 0x3
```

**Notes**
const/4 → 4-bit signed value
Range: -8 to +7

**Larger Value Example**
```
const/16 v0, 0x64
```
0x64 = 100 (decimal)
Range: -32768 to +32767
---
#### String
**Java**
```java
String name = "Player";
```
**Smali**
```
const-string v0, "Player"
```
---
### iget – Read Instance Field
i = instance
get = read value
For static fields use `sget`
**Syntax**
```
iget vx, vy, LclassName;->fieldName:Type
```
**Java**
```java
return this.highScore;
```
**Smali**
```
iget v0, p0, Lde/fgerbig/spacepeng/services/Profile;->highScore:I
return v0
```

## Reference
[https://github.com/h0tak88r/Sec-88/blob/main/android-appsec/smali/smali-cheat-sheet.md](https://github.com/h0tak88r/Sec-88/blob/main/android-appsec/smali/smali-cheat-sheet.md)

