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

import back.config;
import static back.config.con;
import static back.config.rs;
import static back.config.stmt;
import java.sql.DriverManager;
public class idcheck {
    private int id;
    public boolean exists=false;
    public idcheck(int id)
    {
        this.id=id;
        checkIdExistence();
    }
    public boolean idExists()
    {
        return exists;
    }
    public int getId()
    {
        return this.id;
    }
   private void checkIdExistence()
   {
        try {
            
            stmt = con.createStatement();
            rs = stmt.executeQuery("SELECT id FROM `users` WHERE status=1 and privilege!='admin'");
            while(rs.next()){
                if(id==rs.getInt("id"))
                {
                    exists=true;
                }               
}    
           

        } // Handle any errors that may have occurred.
        catch (Exception e) {
            e.printStackTrace();
        }
   }

}

