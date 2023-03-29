import javafx.application.Application;
import javafx.scene.Scene;
import javafx.scene.control.Label;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;

public class MyJavaFXApp extends Application {
    
    @Override
    public void start(Stage primaryStage) {
        // Create a label with some text
        Label label = new Label("Thisis my first JAVA FX Application :)");
        
        // Create a layout pane and add the label to it
        StackPane root = new StackPane();
        root.getChildren().add(label);
        
        // Create a scene with the layout pane
        Scene scene = new Scene(root, 300, 200);
        
        // Set the title of the window
        primaryStage.setTitle("PHPMASTER :)");
        
        // Set the scene for the window and show it
        primaryStage.setScene(scene);
        primaryStage.show();
    }
    
    public static void main(String[] args) {
        launch(args);
    }
}
