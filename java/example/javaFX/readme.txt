=> Setup
	1. download javasdk from here : https://gluonhq.com/products/javafx/
	2. extract the javasdk & we will use later
	3. download screen builder to design app (Additional) : https://gluonhq.com/products/scene-builder/
		- its help to you design your application
		- its User Interface, you can use drag & drop ui component 
		- Alternative you can use fxml to write code to design without screen builder OK !

// complie the code
javac --module-path C:/tools/javafx-sdk-17.0.6/lib --add-modules javafx.controls,javafx.fxml MyJavaFXApp.java

// run the code
java --module-path C:/tools/javafx-sdk-17.0.6/lib --add-modules javafx.controls,javafx.fxml MyJavaFXApp




=> After Build Project

	- Error: JavaFX runtime components are missing, and are required to run this application : javafxsdk not complie
		- java --module-path C:\tools\javafx-sdk-17.0.6\lib  --add-modules javafx.controls,javafx.fxml -jar login.jar