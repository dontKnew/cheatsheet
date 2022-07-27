TypeScript Facts
=> if dont define any properties or variable, its assumed "any" data type. 

1. By interface 
interface User {
name: string;
id: number;
}
1.1 define  in object 
const user: User = {
name: "Hayes",
id: 0,
};
1.2 define in OOP
class UserAccount {
name: string;
id: number; 

constructor(name: string, id: number) {
this.name = name;
this.id = id;
} 

}  

const user: User = new UserAccount("Murphy", 1); 

1.3 define in function
function get():User{}
function  get(user:User){} 

2. Data Type : boolean, bigint, null, number, string, symbol, ,  undefined and any  for  anything allowed 

3. Composing Type are two types
3.1 Unions : we will use "type"  keyword for declare one of many types.
ex. type MyBool = true | false
ex. type WindowStates = "open" | "closed" | "minimized";
type LockStates = "locked" | "unlocked";
type PositiveOddNumbersUnderTen = 1 | 3 | 5 | 7 | 9; 

Ex. function wrapInArray(obj: string | string[]) {
if (typeof obj === "string") {
return [obj];
(parameter) obj: string
}
return obj;
}
3.2 generic : without generic an array could take anything data types, but with generics take only defined data type array
Ex.  type StringArray = Array<String>
Ex. type NumberArray = Array<Number>
Ex. type ObjectArray = Array<{name:"sajid"}>
Ex  interface Backpack<Type> {
add: (obj: Type) => void;
get: () => Type;
} 

// This line is a shortcut to tell TypeScript there is a
// constant called `backpack`, and to not worry about where it came from.
declare const backpack: Backpack<string>; 

// object is a string, because we declared it above as the variable part of Backpack.
const object = backpack.get(); 

// Since the backpack variable is a string, you can't pass a number to the add function.
backpack.add(23); 

Error Return : Argument of type 'number' is not assignable to parameter of type 'string'.Argument of type 'number' is not assignable to parameter of type 'string'. 

=> Structural type program
interface Point {
x: number;
y: number;
}
function logPoint(p: Point) {
console.log(`${p.x}, ${p.y}`);
}
// logs "12, 26"
const point = { x: 12, y: 26 };
logPoint(point); 

The point variable is never declared to be a Point type. However, TypeScript compares the shape of point to the shape of Point in the type-check. They have the same shape, so the code passes.


4. Function
4.1 // Parameter type annotation (data Types)
function greet(name: string) {
console.log("Hello, " + name.toUpperCase() + "!!");
}
4.2 Return Type annotation : thats means function will be always return the value of defined annotation(dataTypes)
Function getNumber() : number{ return 806; } // if u return an string , typescript give an error whenver u complie the code. 

5. Object 
5.1 return an function with an object defined structure annotation 



function sum(obj:{x:number,y:number,hin:string, hin2?:string })  // hin2: is an optional paramter 
or
[
Type DataType = { x:number; y:number,hin:string; hin2?:string}
Or 
interface DataType = { x:number; y:number,hin:string; hin2?:string}
]
function sum(obj:DataType) // this is called TypeAlias 

{
sum({x:10, y:50,hin:"Your sum value is"})
} 

Complied TS to JS
"use strict";
function sum(obj) {
    console.log(obj.hin);
    console.log(obj.x + obj.y);
}
sum({ x: 10, y: 50, hin: "Your  sum value is" });
5.2 different of interface and alias type
=>interface can be add value or field by you using extends/child class, but in alias type can not be add value or filed once its defined:
Ex. 
interface Animal { name: string }
interface Bear extends Animal { honey: boolean }
const bear = getBear() bear.name bear.honey
5.3 combined union with typo/ Interface 
interface Options {
width: number;
}
function configure(x: Options | "auto") {
// ...
}
configure({ width: 100 });


6. Common Primitives 
6.1 bigint : assign large integer , u can define two types in TypeScript
Const onehunder = BigInt(100) // 
const anotheHundred = 100;
6.2 symbol : create a globally unique reference via the function Symbol():
=> liken an c++ pointer function, this symbol function store the variable of reference id. 
Ex. 
const firstName = Symbol("name");
const secondName = Symbol("name");
if (firstName === secondName) { 

//This condition will always return 'false' since the types 'typeof firstName' and 'typeof secondName' have no overlap.This condition will always return 'false' since the types 'typeof firstName' and 'typeof secondName' have no overlap. 

// Can't ever happen
}

7.  typeof  : get an dataTypes from an variable.  Example : 
function (s:string) {
if(typeof s == "string"){ return true;}
else { return false;} 
}
