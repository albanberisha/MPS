/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package back;

/**
 *
 * @author Lenovo
 */
import java.sql.*;

public class config {
public static Connection con = null;
         public static  Statement stmt = null;
         public static ResultSet rs = null;
        private static String user = "root";
         private static  String pass = "";
    public config() {
        // Create a variable for the connection string.
        String connectionUrl = "jdbc:myslq://localhost/mps"
                + "databaseName=mps;user=root;password='';integratedSecurity=true;";

        // Declare the JDBC objects.
         
        try {
            con = DriverManager.getConnection("jdbc:mysql://localhost/mps", user, pass);
            stmt = con.createStatement();
            
        } // Handle any errors that may have occurred.
        catch (Exception e) {
            e.printStackTrace();
        } 
    }

}
