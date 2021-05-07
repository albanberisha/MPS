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
import java.text.SimpleDateFormat;
import java.util.Date;
public class data {
    String condition;
    String bed="1";
    String name=null;
    String surname=null;
    int id;
    public String getcondition()
    {
        return condition;
    }
    public void setcondition(String condition)
    {
        this.condition=condition;
    }
    public String getBed()
    {
        return this.bed;
    }
    
    private int hartRate;
    private int bloodPressure;
    private int respiratoryRate;
    private int temperature;
    private int oxygenAmount;
    private int weight;
     private String time;
      private String date;

    private void setHeartRate(int hrate)
    {
        this.hartRate=hrate;
    }
    public int getHeartRate()
    {
       return this.hartRate;
    }
    private void setbloodPressure(int bloodPressure)
    {
        this.bloodPressure=bloodPressure;
    }
    public int getbloodPressure()
    {
       return this.bloodPressure;
    }
    private void setrespiratoryRate(int respiratoryRate)
    {
        this.respiratoryRate=respiratoryRate;
    }
    public int getrespiratoryRate()
    {
       return this.respiratoryRate;
    }
    private void settemperature(int temperature)
    {
        this.temperature=temperature;
    }
    public int gettemperature()
    {
       return this.temperature;
    }
    private void setoxygenAmount(int oxygenAmount)
    {
        this.oxygenAmount=oxygenAmount;
    }
    public int getoxygenAmount()
    {
       return this.oxygenAmount;
    }private void setweight(int weight)
    {
        this.weight=weight;
    }
    public int getweight()
    {
       return this.weight;
    }


    public void setNameSurname(String name,String surname)
    {
        this.name=name;
        this.surname=surname;
    }
    public String getNameSurname()
    {
        return name+" "+surname;
    }
    
    private void setID(int id)
    {
        this.id=id;
    }
    public int getID()
    {
        return this.id;
    }
    private void setTime(String time)
    {
        this.time=time;
    }
    public String getTime()
    {
        return this.time;
    }
    private void setdate(String date)
    {
        this.date=date;
    }
    public String getdate()
    {
        return this.date;
    }
    public boolean saveData(int userInch,int hrate,int bpress, int fbreath,int temp,int oxg,int weight)
    {
        boolean saved=false;
        try {
           SimpleDateFormat formatter= new SimpleDateFormat("yyyy-MM-dd");
Date date = new Date(System.currentTimeMillis());
String date2=formatter.format(date).toString();
SimpleDateFormat formatter2= new SimpleDateFormat("HH:mm:ss");
Date date1 = new Date(System.currentTimeMillis());
String date3=formatter2.format(date1).toString();
        int rez = stmt.executeUpdate("UPDATE actual_condition SET date='"+date2+"',time='"+date3+"', userInCharge="+userInch+",heart_rate="+hrate+",blood_pressure="+bpress+",respiratory_rate="+fbreath+",temperature="+temp+",oxygen_amount="+oxg+",weight="+weight+" WHERE bedId="+this.bed);
        if(rez!=0)
        {
            saved=true;
        }
        } // Handle any errors that may have occurred.
        catch (Exception e) {
            e.printStackTrace();
        }
        return saved;
    }
    public data()
    {
        try {
            
            stmt = con.createStatement();
            rs = stmt.executeQuery("SELECT beds.id as bednumber,beds.condition,beds.patientId,patients.name,patients.surname,actual_condition.date,actual_condition.time,actual_condition.heart_rate,actual_condition.blood_pressure,actual_condition.respiratory_rate,actual_condition.temperature,actual_condition.oxygen_amount,actual_condition.weight from beds,patients,actual_condition Where beds.patientId=patients.id and beds.id="+this.bed+" and actual_condition.bedId= beds.id");
            if(rs.next()){
                setID(rs.getInt("patientId"));
                setcondition(rs.getString("condition"));
                setHeartRate(rs.getInt("heart_rate"));
                setbloodPressure(rs.getInt("blood_pressure"));
                setrespiratoryRate(rs.getInt("respiratory_rate"));
                settemperature(rs.getInt("temperature"));
                setoxygenAmount(rs.getInt("oxygen_amount"));
                setweight(rs.getInt("weight"));
                setTime(rs.getString("time"));
                setdate(rs.getString("date"));
                if(rs.getString("name")!=null)
                {
                     setNameSurname(rs.getString("name"),rs.getString("surname"));
                }else{}
               
}    
           

        } // Handle any errors that may have occurred.
        catch (Exception e) {
            e.printStackTrace();
        }

    }
}
