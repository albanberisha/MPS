package front;

import static back.config.con;
import static back.config.rs;
import static back.config.stmt;
import back.data;
import java.awt.Button;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.JSeparator;
import javax.swing.SwingConstants;
import javax.swing.JTextArea;
import java.awt.Color;
import java.awt.Component;
import java.awt.Dialog.ModalityType;
import java.awt.Dimension;
import java.awt.Frame;
import java.awt.Insets;
import java.awt.Toolkit;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.awt.event.FocusEvent;
import java.awt.event.FocusListener;
import java.awt.event.InputMethodListener;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;
import java.util.concurrent.TimeUnit;
import javax.swing.BorderFactory;
import javax.swing.JDialog;
import javax.swing.JOptionPane;
import javax.swing.JTextField;
import javax.swing.border.LineBorder;

/**
 * PatientInfo- creates GUI for patient information.
 *
 * @author Alban Berisha
 * @version 1.0
 * @since 2021-05-05
 */
public class PatientInfo {

    private JFrame f;//second frame
    private JFrame frame;//main frame
    public int uInCharge;
    //private JTextField lbl1d;
    //private JTextField lbl2ll;
    int diffh = 50;//distance between components
    int widhhlf;//half widh of window

    /**
     * PatientInfo- creates GUI for patient information.
     *
     * @param frame This is the main frame
     */
    public PatientInfo(JFrame frame,int userinCharge) {
        this.frame = frame;
        this.uInCharge=userinCharge;
        initialize(frame);
    }

    /**
     * Initialize the contents of the frame.
     */
    private void initialize(JFrame frame) {
        data d = new data();
        frame.getContentPane().removeAll();
        frame.repaint();
        frame.setExtendedState(JFrame.MAXIMIZED_BOTH);
        frame.setVisible(true);
        frame.getContentPane().setBackground(new Color(242, 242, 242));
        //frame.setBounds(0,0,1366, 768);
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.getContentPane().setLayout(null);

        Dimension screenSize = Toolkit.getDefaultToolkit().getScreenSize();
        // the screen height
        double y = screenSize.getHeight();
        // the screen width
        double x = screenSize.getWidth();

        int startxx = 26;//Content in frame starts at this X-point
        int startyy = 11;//Content in frame starts at this Y-point
JLabel lblHeraEFundit = new JLabel("Hera e fundit e p\u00EBrdit\u00EBsimit:");
        int widthmax = (int) (x / 2) - 52;//Wdith of content in one half
        if(d.getdate()==null)
        {
             lblHeraEFundit.setText("Hera e fundit e p\u00EBrdit\u00EBsimit:");
        }else{
            lblHeraEFundit.setText("Hera e fundit e p\u00EBrdit\u00EBsimit:"+d.getdate()+" "+d.getTime());
        }
        
        lblHeraEFundit.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        lblHeraEFundit.setBounds(startxx, startyy, widthmax, 39);
        frame.getContentPane().add(lblHeraEFundit);
        /*
		JLabel lblNewLabel = new JLabel("21.04.2021 14:02");
		lblNewLabel.setFont(new Font("Century Gothic", Font.PLAIN, 30));
		lblNewLabel.setBounds(223, 18, 151, 25);
		frame.getContentPane().add(lblNewLabel);
         */

        JLabel lblBreath = new JLabel("Frekuenca e frymëmarrjes:");
        Dimension sizee = lblBreath.getPreferredSize();
        widhhlf = sizee.width * 2;
        lblBreath.setFont(new Font("Century Gothic", Font.PLAIN, 20));
        lblBreath.setBounds(startxx, diffh * 4, widhhlf, 39);
        frame.getContentPane().add(lblBreath);

        JLabel lblhartrate = new JLabel("Rrahjet e zemres:");
        lblhartrate.setFont(new Font("Century Gothic", Font.PLAIN, 20));
        lblhartrate.setBounds(startxx, diffh * 2, widhhlf, 39);
        frame.getContentPane().add(lblhartrate);

        JLabel lblBloodPress = new JLabel("Presioni i gjakut:");
        lblBloodPress.setFont(new Font("Century Gothic", Font.PLAIN, 20));
        lblBloodPress.setBounds(startxx, diffh * 3, widhhlf, 39);
        frame.getContentPane().add(lblBloodPress);

        JLabel lblTemp = new JLabel("Temperatura:");
        lblTemp.setFont(new Font("Century Gothic", Font.PLAIN, 20));
        lblTemp.setBounds(startxx, diffh * 5, widhhlf, 39);
        frame.getContentPane().add(lblTemp);

        JLabel lblOxg = new JLabel("Sasia e oksigjenit:");
        lblOxg.setFont(new Font("Century Gothic", Font.PLAIN, 20));
        lblOxg.setBounds(startxx, diffh * 6, widhhlf, 39);
        frame.getContentPane().add(lblOxg);

        JLabel lblWeight = new JLabel("Pesha:");
        lblWeight.setFont(new Font("Century Gothic", Font.PLAIN, 20));
        lblWeight.setBounds(startxx, diffh * 7, widhhlf, 39);
        frame.getContentPane().add(lblWeight);

        /*
		JButton btnNdrysho = new JButton("Ruaj");
		btnNdrysho.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				
				//Ndrysho 1
				//emrat e labels per me i ndryshu jane lbl1d, lbl-rreshti-p(pershkrimi)
			}
		});
		btnNdrysho.setBounds(845, 99, 117, 44);
		frame.getContentPane().add(btnNdrysho);
         */
        setHartRate(d);
        setBloodPressure(d);
        setBreath(d);
        setOxg(d);
        setTemp(d);
        setWeight(d);

        drawForm();

        /*
        *Middle line in the window, splitting window in 2 parts
         */
        JSeparator separator = new JSeparator();
        separator.setOrientation(SwingConstants.VERTICAL);
        separator.setBounds((int) x / 2, 0, 680, 919);
        frame.getContentPane().add(separator);

        JButton btnBack = new JButton("Kthehu mbrapa");
        btnBack.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                new MainWindow();
              frame.dispose();
               
            }
        });
        btnBack.setBackground(new Color(214, 251, 255));//import java.awt.Color;
        btnBack.setForeground(Color.BLACK);
        btnBack.setBounds((int) x / 6, diffh * 10, 200, 44);
        frame.getContentPane().add(btnBack);
        
        JButton btnSave = new JButton("Ruaj");
        btnSave.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                // te dhenat per presion,.... jane me readhe TextArea, TextArea1,....
                int hrate = Integer.parseInt(getHartRate());
                int bpress = Integer.parseInt(getBloodPressure());
                int fbreath = Integer.parseInt(getBreath());
                int temp = Integer.parseInt(getTemp());
                int oxg = Integer.parseInt(getOxg());
                int weight = Integer.parseInt(getWeight());
                boolean saved=d.saveData(uInCharge,hrate,bpress,fbreath,temp,oxg,weight);
                if(saved)
                {
                    JOptionPane.showMessageDialog(frame, "Te dhenat u ruajten me sukses");
                }else{
                 JOptionPane.showMessageDialog(frame, "Ka ndodhur nje gabim. Kontaktoni administratorin");}
                
            }
        });
        btnSave.setBackground(new Color(107, 142, 35));
        btnSave.setBounds((int) x / 5, diffh * 9, 106, 44);
        frame.getContentPane().add(btnSave);

        int width = (int) (x / 6);
        int x1start = (int) (x / 2) + 20;
        int x2start = (int) x1start + width;
        int x3start = (int) x2start + width;
        int ystart = 115;
        int diff = 0;

        JLabel lblMedList = new JLabel("Lista e medikamenteve");
        lblMedList.setFont(new Font("Century Gothic", Font.BOLD, 30));
        lblMedList.setBounds(x1start, 11, (int) (x / 2) - 10, 39);
        frame.getContentPane().add(lblMedList);

        JLabel lblType = new JLabel("Lloji");
        lblType.setFont(new Font("Century Gothic", Font.BOLD, 20));
        lblType.setBounds(x1start, ystart - 65, width - 10, 39);
        frame.getContentPane().add(lblType);

        JLabel lblDescription = new JLabel("P\u00EBrshkrimi");
        lblDescription.setFont(new Font("Century Gothic", Font.BOLD, 20));
        lblDescription.setBounds(x2start, ystart - 65, width - 10, 39);
        frame.getContentPane().add(lblDescription);

        JLabel lblData = new JLabel("Data");
        lblData.setFont(new Font("Century Gothic", Font.BOLD, 20));
        lblData.setBounds(x3start, ystart - 65, width - 10, 39);
        frame.getContentPane().add(lblData);
        try {

            stmt = con.createStatement();
            rs = stmt.executeQuery("SELECT medicaments.name,med_history.medUsage,med_history.endUseDate FROM med_history,medicaments WHERE med_history.medicamentId=medicaments.id and med_history.patientId=" + d.getID() + " and med_history.endUseDate>=CURDATE()");
            while (rs.next()) {
JLabel lmed = new JLabel(rs.getString("name"));
            lmed.setForeground(Color.BLACK);
            lmed.setFont(new Font("Century Gothic", Font.PLAIN, 20));
            lmed.setBounds(x1start, ystart + diff, width - 10, 20);
            frame.getContentPane().add(lmed);
            JLabel lmed2 = new JLabel(rs.getString("medUsage"));
            lmed2.setForeground(Color.BLACK);
            lmed2.setFont(new Font("Century Gothic", Font.PLAIN, 20));
            lmed2.setBounds(x2start, ystart + diff, width - 10, 20);
            frame.getContentPane().add(lmed2);
            JLabel lmed3 = new JLabel(rs.getString("endUseDate"));
            lmed3.setForeground(Color.BLACK);
            lmed3.setFont(new Font("Century Gothic", Font.PLAIN, 20));
            lmed3.setBounds(x3start, ystart + diff, width - 10, 20);
            frame.getContentPane().add(lmed3);
            diff += 53;
            }

        } // Handle any errors that may have occurred.
        catch (Exception e) {
            e.printStackTrace();
        }

       
    }

    /**
     * This method draws a form. This is a the simplest form of a class method,
     * it is used to get data for actual condition of patient
     */
    private void drawForm() {
        JButton buttonHartRate = new JButton();
        buttonHartRate.setText(getHartRate());
        buttonHartRate.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {

                addHartRate(drawInputNum(widhhlf, diffh * 2 - 10, 106, 39, 1));
                buttonHartRate.setText(getHartRate());
            }
        });
        buttonHartRate.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        buttonHartRate.setFont(new Font("Century Gothic", Font.PLAIN, 25));
        buttonHartRate.setBounds(widhhlf, diffh * 2, 106, 35);
        buttonHartRate.setMargin(new Insets(1, 1, 1, 1));
        buttonHartRate.setForeground(new Color(240, 255, 255));
        buttonHartRate.setBackground(new Color(0, 0, 0));
        buttonHartRate.setFocusPainted(false);
        frame.getContentPane().add(buttonHartRate);
        /*
                            JTextArea textAreaHRate = new JTextArea();
		textAreaHRate.setFont(new Font("Century Gothic", Font.PLAIN, 26));
		textAreaHRate.setForeground(new Color(240, 255, 255));
		textAreaHRate.setText("180");
		textAreaHRate.setBackground(new Color(0, 0, 0));
		textAreaHRate.setBounds(widhhlf, diffh*2, 106, 39);
		frame.getContentPane().add(textAreaHRate);
		JTextArea textAreaBPressure = new JTextArea();               
		textAreaBPressure.setText(bloodPressure);
		textAreaBPressure.setFont(new Font("Century Gothic", Font.PLAIN, 26));
		textAreaBPressure.setForeground(new Color(240, 255, 255));
		textAreaBPressure.setBackground(new Color(0, 0, 0));
		textAreaBPressure.setBounds(widhhlf, diffh*3, 106, 39);
		frame.getContentPane().add(textAreaBPressure);
         */

        JButton buttonBpress = new JButton();
        buttonBpress.setText(getBloodPressure());
        buttonBpress.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {

                addBloodPressure(drawInputNum(widhhlf, diffh * 3 - 10, 106, 39, 2));
                buttonBpress.setText(getBloodPressure());
            }
        });
        buttonBpress.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        buttonBpress.setFont(new Font("Century Gothic", Font.PLAIN, 25));
        buttonBpress.setBounds(widhhlf, diffh * 3, 106, 35);
        buttonBpress.setMargin(new Insets(1, 1, 1, 1));
        buttonBpress.setForeground(new Color(240, 255, 255));
        buttonBpress.setBackground(new Color(0, 0, 0));
        buttonBpress.setFocusPainted(false);
        frame.getContentPane().add(buttonBpress);

        JButton buttonBreath = new JButton();
        buttonBreath.setText(getBreath());
        buttonBreath.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {

                addBreath(drawInputNum(widhhlf, diffh * 4 - 10, 106, 39, 3));
                buttonBreath.setText(getBreath());
            }
        });
        buttonBreath.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        buttonBreath.setFont(new Font("Century Gothic", Font.PLAIN, 25));
        buttonBreath.setBounds(widhhlf, diffh * 4, 106, 35);
        buttonBreath.setMargin(new Insets(1, 1, 1, 1));
        buttonBreath.setForeground(new Color(240, 255, 255));
        buttonBreath.setBackground(new Color(0, 0, 0));
        buttonBreath.setFocusPainted(false);
        frame.getContentPane().add(buttonBreath);

        /*
		JTextArea textAreaBreath = new JTextArea();
		textAreaBreath.setText("36.5");
		textAreaBreath.setFont(new Font("Century Gothic", Font.PLAIN, 26));
		textAreaBreath.setForeground(new Color(240, 255, 255));
		textAreaBreath.setBackground(new Color(0, 0, 0));
		textAreaBreath.setBounds(widhhlf, diffh*4, 106, 39);
		frame.getContentPane().add(textAreaBreath);
		
		JTextArea textAreaTemp = new JTextArea();
		textAreaTemp.setText("180");
		textAreaTemp.setFont(new Font("Century Gothic", Font.PLAIN, 26));
		textAreaTemp.setForeground(new Color(240, 255, 255));
		textAreaTemp.setBackground(new Color(0, 0, 0));
		textAreaTemp.setBounds(widhhlf, diffh*5, 106, 39);
		frame.getContentPane().add(textAreaTemp);
         */
        JButton buttonTemp = new JButton();
        buttonTemp.setText(getTemp());
        buttonTemp.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {

                addTemp(drawInputNum(widhhlf, diffh * 5 - 10, 106, 39, 4));
                buttonTemp.setText(getTemp());
            }
        });
        buttonTemp.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        buttonTemp.setFont(new Font("Century Gothic", Font.PLAIN, 25));
        buttonTemp.setBounds(widhhlf, diffh * 5, 106, 35);
        buttonTemp.setMargin(new Insets(1, 1, 1, 1));
        buttonTemp.setForeground(new Color(240, 255, 255));
        buttonTemp.setBackground(new Color(0, 0, 0));
        buttonTemp.setFocusPainted(false);
        frame.getContentPane().add(buttonTemp);

        /*
                JTextArea textAreaOxg = new JTextArea();
		textAreaOxg.setText("180");
		textAreaOxg.setFont(new Font("Century Gothic", Font.PLAIN, 26));
		textAreaOxg.setForeground(new Color(240, 255, 255));
		textAreaOxg.setBackground(new Color(0, 0, 0));
		textAreaOxg.setBounds(widhhlf, diffh*6, 106, 39);
		frame.getContentPane().add(textAreaOxg);
         */
        JButton buttonOxg = new JButton();
        buttonOxg.setText(getOxg());
        buttonOxg.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {

                addOxg(drawInputNum(widhhlf, diffh * 6 - 10, 106, 39, 5));
                buttonOxg.setText(getOxg());
            }
        });
        buttonOxg.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        buttonOxg.setFont(new Font("Century Gothic", Font.PLAIN, 25));
        buttonOxg.setBounds(widhhlf, diffh * 6, 106, 35);
        buttonOxg.setMargin(new Insets(1, 1, 1, 1));
        buttonOxg.setForeground(new Color(240, 255, 255));
        buttonOxg.setBackground(new Color(0, 0, 0));
        buttonOxg.setFocusPainted(false);
        frame.getContentPane().add(buttonOxg);

        /*
                JTextArea textAreaWeight = new JTextArea();
                textAreaWeight.setText("180");
		textAreaWeight.setFont(new Font("Century Gothic", Font.PLAIN, 26));
		textAreaWeight.setForeground(new Color(240, 255, 255));
		textAreaWeight.setBackground(new Color(0, 0, 0));
		textAreaWeight.setBounds(widhhlf, diffh*7, 106, 39);
		frame.getContentPane().add(textAreaWeight);
        
         */
        JButton buttonWeight = new JButton();
        buttonWeight.setText(getWeight());
        buttonWeight.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {

                addWeight(drawInputNum(widhhlf, diffh * 7 - 10, 106, 39, 6));
                buttonWeight.setText(getWeight());
            }
        });
        buttonWeight.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        buttonWeight.setFont(new Font("Century Gothic", Font.PLAIN, 25));
        buttonWeight.setBounds(widhhlf, diffh * 7, 106, 35);
        buttonWeight.setMargin(new Insets(1, 1, 1, 1));
        buttonWeight.setForeground(new Color(240, 255, 255));
        buttonWeight.setBackground(new Color(0, 0, 0));
        buttonWeight.setFocusPainted(false);
        frame.getContentPane().add(buttonWeight);
    }

    String hartRate;
    String bloodPressure;
    String breathP;
    String tempP;
    String oxgP;
    String weightP;

    /**
     * This method is used to set hartRate value.
     */
    private void setHartRate(data d) {
        this.hartRate = d.getHeartRate() + "";
    }

    /**
     * This method is used to get hartRate value.
     *
     * @return String This returns hart rate of patient.
     */
    private String getHartRate() {

        return hartRate;
    }

    /**
     * This method is used to add hartRate value.
     *
     * * @param i This is the string to add in the value
     */
    private void addHartRate(String i) {
        if (i.equals("-1")) {
            this.hartRate = "";
        } else {
            this.hartRate = hartRate + i;
        }

    }

    /**
     * This method is used to set bloodPressure value.
     */
    private void setBloodPressure(data d) {
        this.bloodPressure = d.getbloodPressure() + "";
    }

    /**
     * This method is used to get bloodPressure value.
     *
     * @return String This returns blood pressure of patient.
     */
    private String getBloodPressure() {

        return bloodPressure;
    }

    /**
     * This method is used to add bloodPressure value.
     *
     * * @param i This is the string to add in the value
     */
    private void addBloodPressure(String i) {
        if (i.equals("-1")) {
            this.bloodPressure = "";
        } else {
            this.bloodPressure = bloodPressure + i;
        }

    }

    /**
     * This method is used to set breathP value.
     */
    private void setBreath(data d) {
        this.breathP = d.getrespiratoryRate() + "";
    }

    /**
     * This method is used to get breathP value.
     *
     * @return String This returns breath frequence of patient.
     */
    private String getBreath() {

        return breathP;
    }

    /**
     * This method is used to add breathP value.
     *
     * * @param i This is the string to add in the value
     */
    private void addBreath(String i) {
        if (i.equals("-1")) {
            this.breathP = "";
        } else {
            this.breathP = breathP + i;
        }
    }

    /**
     * This method is used to set tempP value.
     */
    private void setTemp(data d) {
        this.tempP = d.gettemperature() + "";
    }

    /**
     * This method is used to get tempP value.
     *
     * @return String This returns temperature of patient.
     */
    private String getTemp() {

        return tempP;
    }

    /**
     * This method is used to add tempP value.
     *
     * * @param i This is the string to add in the value
     */
    private void addTemp(String i) {

        if (i.equals("-1")) {
            this.tempP = "";
        } else {
            this.tempP = tempP + i;
        }
    }

    /**
     * This method is used to set oxgP value.
     */
    private void setOxg(data d) {
        this.oxgP = d.getoxygenAmount() + "";
    }

    /**
     * This method is used to get oxgP value.
     *
     * @return String This returns oxygen of patient.
     */
    private String getOxg() {

        return oxgP;
    }

    /**
     * This method is used to add oxgP value.
     *
     * * @param i This is the string to add in the value
     */
    private void addOxg(String i) {

        if (i.equals("-1")) {
            this.oxgP = "";
        } else {
            this.oxgP = oxgP + i;
        }
    }

    /**
     * This method is used to set weightP value.
     */
    private void setWeight(data d) {
        this.weightP = d.getweight() + "";
    }

    /**
     * This method is used to get weightP value.
     *
     * @return String This returns weight of patient.
     */
    private String getWeight() {

        return weightP;
    }

    /**
     * This method is used to add weightP value.
     *
     * * @param i This is the string to add in the value
     */
    private void addWeight(String i) {

        if (i.equals("-1")) {
            this.weightP = "";
        } else {
            this.weightP = weightP + i;
        }
    }

    /**
     * This method is used to add value to specific condition.
     *
     * @param i This is the string to add
     * @param type This is the type of condition
     */
    private void addActual(String i, int type) {
        switch (type) {
            case 1:
                addHartRate(i);
                break;
            case 2:
                addBloodPressure(i);
                break;
            case 3:
                addBreath(i);
                break;
            case 4:
                addTemp(i);
                break;
            case 5:
                addOxg(i);
                break;
            case 6:
                addWeight(i);
                break;
            default:
            // code block
        }
    }

    /**
     * This method is used to get current condition.
     *
     * @param type This is the type of condition
     * @return String This returns actual condition.
     */
    private String getCurr(int type) {
        switch (type) {
            case 1:
                return getHartRate();
            case 2:
                return getBloodPressure();
            case 3:
                return getBreath();
            case 4:
                return getTemp();
            case 5:
                return getOxg();
            case 6:
                return getWeight();
            default:
                return "-1";
        }
    }

    /**
     * This method is used to draw the input numbers.
     *
     * @param w This is the width of frame
     * @param diff This is height between components
     * @param buttonw This is the width of buttons
     * @param buttonh This is the height of buttons
     * @param type This is the type of condition
     * @return String This returns input.
     */
    public String drawInputNum(int w, int diff, int buttonw, int buttonh, int type) {
        String input = "";

        int framew = 3 * 74 + 20;
        int framestart = (int) (w - framew / 3) - 10;
        int frameh = 422;
        int startx = 10;
        int starty = 10;
        f = new JFrame();
        f.setAlwaysOnTop(true);
        f.setBounds(0, 0, 1366, 768);
        f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        f.getContentPane().setLayout(null);

        JDialog dialog = new JDialog();
        dialog = new JDialog(f, "Dialog Example", true);

        JTextField textInput = new JTextField();
        textInput.setText(getCurr(type));
        textInput.setFont(new Font("Century Gothic", Font.PLAIN, 26));
        textInput.setBorder(new LineBorder(new Color(230, 230, 230), 1));
        textInput.setForeground(Color.white);
        textInput.setBackground(Color.black);
        textInput.setBounds((int) startx + framew / 3, starty, 106, 39);
        dialog.add(textInput);
        //frame.getContentPane().add(textInput);

        JButton btnDel = new JButton("Fshi");
        //btnDel.setBounds(900, 380, 380, 270);
        btnDel.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                if (textInput.getText().length() != 0) {
                    addActual("-1", type);
                    textInput.setText("");
                }
            }
        });
        btnDel.setFont(new Font("Century Gothic", Font.PLAIN, 15));
        btnDel.setBounds(startx, starty, 70, 39);
        btnDel.setFont(new Font("Serif", Font.BOLD, 15));
        btnDel.setBackground(new Color(255, 71, 26));//import java.awt.Color;
        btnDel.setForeground(Color.BLACK);
        btnDel.setFocusPainted(false);
        dialog.getContentPane().add(btnDel);

        JButton button1 = new JButton("1");
        button1.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addActual("1", type);
                textInput.setText(textInput.getText() + "1");
            }
        });
        button1.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        button1.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button1.setBounds(startx, starty + 118 - 44, 74, 55);
        button1.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button1.setForeground(Color.BLACK);
        button1.setFocusPainted(false);
        dialog.add(button1);

        JButton button2 = new JButton("2");
        button2.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addActual("2", type);
                textInput.setText(textInput.getText() + "2");
                //f.dispose();
                //drawForm();
            }
        });
        button2.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        button2.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button2.setBounds(startx + 84, starty + 118 - 44, 74, 55);
        button2.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button2.setForeground(Color.BLACK);
        button2.setFocusPainted(false);
        dialog.getContentPane().add(button2);

        JButton button3 = new JButton("3");
        button3.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addActual("3", type);
                textInput.setText(textInput.getText() + "3");
            }
        });
        button3.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        button3.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button3.setBounds(startx + 168, starty + 118 - 44, 74, 55);
        button3.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button3.setForeground(Color.BLACK);
        button3.setFocusPainted(false);
        dialog.getContentPane().add(button3);

        JButton button4 = new JButton("4");
        button4.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addActual("4", type);
                textInput.setText(textInput.getText() + "4");
            }
        });
        button4.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        button4.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button4.setBounds(startx, starty + 186 - 44, 74, 55);
        button4.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button4.setForeground(Color.BLACK);
        button4.setFocusPainted(false);
        dialog.getContentPane().add(button4);

        JButton button5 = new JButton("5");
        button5.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addActual("5", type);
                textInput.setText(textInput.getText() + "5");
            }
        });
        button5.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {

            }
        });
        button5.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button5.setBounds(startx + 84, starty + 186 - 44, 74, 55);
        button5.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button5.setForeground(Color.BLACK);
        button5.setFocusPainted(false);
        dialog.getContentPane().add(button5);

        JButton button6 = new JButton("6");
        button6.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addActual("6", type);
                textInput.setText(textInput.getText() + "6");
            }
        });
        button6.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {

            }
        });
        button6.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button6.setBounds(startx + 168, starty + 186 - 44, 74, 55);
        button6.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button6.setForeground(Color.BLACK);
        button6.setFocusPainted(false);
        dialog.getContentPane().add(button6);

        JButton button7 = new JButton("7");
        button7.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addActual("7", type);
                textInput.setText(textInput.getText() + "7");
            }
        });
        button7.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {

            }
        });
        button7.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button7.setBounds(startx, starty + 252 - 44, 74, 55);
        button7.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button7.setForeground(Color.BLACK);
        button7.setFocusPainted(false);
        dialog.getContentPane().add(button7);

        JButton button8 = new JButton("8");
        button8.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addActual("8", type);
                textInput.setText(textInput.getText() + "8");
            }
        });
        button8.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {

            }
        });
        button8.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button8.setBounds(startx + 84, starty + 252 - 44, 74, 55);
        button8.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button8.setForeground(Color.BLACK);
        button8.setFocusPainted(false);
        dialog.getContentPane().add(button8);

        JButton button9 = new JButton("9");
        button9.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addActual("9", type);
                textInput.setText(textInput.getText() + "9");
            }
        });
        button9.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {

            }
        });
        button9.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button9.setBounds(startx + 168, starty + 252 - 44, 74, 55);
        button9.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button9.setForeground(Color.BLACK);
        button9.setFocusPainted(false);
        dialog.getContentPane().add(button9);
        /*
        JButton button10 = new JButton(".");
		button10.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				addBloodPressure(".");
                 textInput.setText(textInput.getText() + ".");
			}
		});
		button10.addKeyListener(new KeyAdapter() {
			@Override
			public void keyPressed(KeyEvent arg0) {
			}
		});
		button10.setFont(new Font("Century Gothic", Font.PLAIN, 30));
		button10.setBounds(startx, starty+318-44, 74, 55);
                button10.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button10.setForeground(Color.BLACK);
        button10.setFocusPainted(false);
		dialog.getContentPane().add(button10);
         */
        JButton button0 = new JButton("0");
        button0.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addActual("0", type);
                textInput.setText(textInput.getText() + "0");
            }
        });
        button0.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        button0.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button0.setBounds(startx + 84, starty + 318 - 44, 74, 55);
        button0.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button0.setForeground(Color.BLACK);
        button0.setFocusPainted(false);
        dialog.getContentPane().add(button0);
        /*
        JButton button11 = new JButton(",");
		button11.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				 addBloodPressure(",");
                 textInput.setText(textInput.getText() + ",");
			}
		});
		button11.addKeyListener(new KeyAdapter() {
			@Override
			public void keyPressed(KeyEvent arg0) {
			}
		});
		button11.setFont(new Font("Century Gothic", Font.PLAIN, 30));
		button11.setBounds(startx+168,starty+318-44, 74, 55);
                 button11.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button11.setForeground(Color.BLACK);
        button11.setFocusPainted(false);
		dialog.getContentPane().add(button11);
                
         */
        JButton btnClose = new JButton("Mbyll");
        btnClose.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                f.dispose();
                drawForm();
            }
        });
        btnClose.setFont(new Font("Century Gothic", Font.PLAIN, 15));
        btnClose.setBounds(startx, starty + 422 - 44, 3 * 74 + 20, 55);
        btnClose.setBackground(Color.BLUE);//import java.awt.Color;
        btnClose.setForeground(Color.BLACK);
        btnClose.setFocusPainted(false);
        dialog.getContentPane().add(btnClose);

        dialog.setBounds(framestart, diff, 3 * 74 + 20 + 20, 422 + 55);
        dialog.getContentPane().setBackground(new Color(255, 255, 255));
        //frame.setBounds(0,0,1366, 768);
        dialog.getRootPane().setBorder(BorderFactory.createLineBorder(Color.BLUE));
        dialog.getContentPane().setLayout(null);
        dialog.setUndecorated(true);
        dialog.setVisible(true);

        //frame.getContentPane().add(button);
        return input;
    }
}
