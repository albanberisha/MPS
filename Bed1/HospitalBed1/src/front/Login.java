package front;

import back.idcheck;
import java.awt.EventQueue;

import javax.swing.JFrame;
import java.awt.Color;
import java.awt.Dimension;
import javax.swing.JPasswordField;
import javax.swing.JLabel;
import java.awt.Font;
import java.awt.Toolkit;
import javax.swing.JButton;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import javax.swing.BorderFactory;
import javax.swing.ImageIcon;
import javax.swing.JOptionPane;
import javax.swing.border.LineBorder;

public class Login {

    private JFrame frame;
    private JPasswordField passwordField;

    /**
     * Launch the application.
     */
    /**
     * Create the application.
     */
    public Login(JFrame frame) {
        this.frame = frame;
        logIn();
    }

    /**
     * Initialize the contents of the frame.
     */
    private void logIn() {
        frame.getContentPane().removeAll();
        frame.repaint();
        frame.setExtendedState(JFrame.MAXIMIZED_BOTH);
        frame.setVisible(true);
        frame.getContentPane().setBackground(new Color(242, 242, 242));
        //frame.setBounds(0,0,1366, 768);
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.getContentPane().setLayout(null);

        int startx = 0;
        int starty = 0;
        int framew = 3 * 74 + 20;
        int frameh = 422 + 55;
        Dimension screenSize = Toolkit.getDefaultToolkit().getScreenSize();
        // the screen height
        double y = screenSize.getHeight();

// the screen width
        double x = screenSize.getWidth();

        startx = (int) ((x / 2) - (framew / 2));
        starty = (int) ((y / 2) - (frameh / 2));
        JLabel lblShnoId = new JLabel("Sh\u00EBno kodin:");
        lblShnoId.setForeground(Color.BLACK);
        lblShnoId.setFont(new Font("Century Gothic", Font.PLAIN, 35));
        lblShnoId.setBounds(startx, starty, 279, 44);
        frame.getContentPane().add(lblShnoId);

        passwordField = new JPasswordField();
        passwordField.setFont(new Font("Tahoma", Font.PLAIN, 22));
        passwordField.setBounds(startx, starty + 55, 2 * 74 + 10, 55);
        passwordField.setBorder(new LineBorder(new Color(230,230,230),1));
        frame.getContentPane().add(passwordField);

        JButton btnDel = new JButton("Fshi");
        //btnDel.setBounds(900, 380, 380, 270);
        btnDel.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                if (passwordField.getText().length() != 0) {
                    passwordField.setText("");
                }
            }
        });
        btnDel.setFont(new Font("Century Gothic", Font.PLAIN, 15));
        btnDel.setBounds(startx + 168, starty + 55, 74, 55);
        btnDel.setFont(new Font("Serif", Font.BOLD, 15));
        btnDel.setBackground(new Color(255, 71, 26));//import java.awt.Color;
        btnDel.setForeground(Color.BLACK);
        btnDel.setFocusPainted(false);
        frame.getContentPane().add(btnDel);

        JButton button = new JButton("1");
        button.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addText("1");
            }
        });
        button.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        button.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button.setBounds(startx, starty + 118, 74, 55);
        button.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button.setForeground(Color.BLACK);
        button.setFocusPainted(false);
        frame.getContentPane().add(button);

        JButton button_1 = new JButton("2");
        button_1.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addText("2");
            }
        });
        button_1.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        button_1.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button_1.setBounds(startx + 84, starty + 118, 74, 55);
        button_1.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button_1.setForeground(Color.BLACK);
        button_1.setFocusPainted(false);
        frame.getContentPane().add(button_1);

        JButton button_2 = new JButton("3");
        button_2.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addText("3");
            }
        });
        button_2.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        button_2.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button_2.setBounds(startx + 168, starty + 118, 74, 55);
        button_2.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button_2.setForeground(Color.BLACK);
        button_2.setFocusPainted(false);
        frame.getContentPane().add(button_2);

        JButton button_3 = new JButton("4");
        button_3.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addText("4");
            }
        });
        button_3.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        button_3.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button_3.setBounds(startx, starty + 186, 74, 55);
        button_3.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button_3.setForeground(Color.BLACK);
        button_3.setFocusPainted(false);
        frame.getContentPane().add(button_3);

        JButton button_4 = new JButton("5");
        button_4.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addText("5");
            }
        });
        button_4.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {

            }
        });
        button_4.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button_4.setBounds(startx + 84, starty + 186, 74, 55);
        button_4.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button_4.setForeground(Color.BLACK);
        button_4.setFocusPainted(false);
        frame.getContentPane().add(button_4);

        JButton button_5 = new JButton("6");
        button_5.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addText("6");
            }
        });
        button_5.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {

            }
        });
        button_5.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button_5.setBounds(startx + 168, starty + 186, 74, 55);
        button_5.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button_5.setForeground(Color.BLACK);
        button_5.setFocusPainted(false);
        frame.getContentPane().add(button_5);

        JButton button_6 = new JButton("7");
        button_6.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addText("7");
            }
        });
        button_6.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {

            }
        });
        button_6.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button_6.setBounds(startx, starty + 252, 74, 55);
        button_6.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button_6.setForeground(Color.BLACK);
        button_6.setFocusPainted(false);
        frame.getContentPane().add(button_6);

        JButton button_7 = new JButton("8");
        button_7.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addText("8");
            }
        });
        button_7.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
                addText("8");
            }
        });
        button_7.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button_7.setBounds(startx + 84, starty + 252, 74, 55);
        button_7.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button_7.setForeground(Color.BLACK);
        button_7.setFocusPainted(false);
        frame.getContentPane().add(button_7);

        JButton button_8 = new JButton("9");
        button_8.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addText("9");
            }
        });
        button_8.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
                addText("9");
            }
        });
        button_8.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button_8.setBounds(startx + 168, starty + 252, 74, 55);
        button_8.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button_8.setForeground(Color.BLACK);
        button_8.setFocusPainted(false);
        frame.getContentPane().add(button_8);
        /*
		JButton button_9 = new JButton("*");
		button_9.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				addText("*");
			}
		});
		button_9.addKeyListener(new KeyAdapter() {
			@Override
			public void keyPressed(KeyEvent arg0) {
			}
		});
		button_9.setFont(new Font("Century Gothic", Font.PLAIN, 30));
		button_9.setBounds(startx, starty+318, 74, 55);
		frame.getContentPane().add(button_9);
         */
        JButton button_10 = new JButton("0");
        button_10.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                addText("0");
            }
        });
        button_10.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent arg0) {
            }
        });
        button_10.setFont(new Font("Century Gothic", Font.PLAIN, 30));
        button_10.setBounds(startx + 84, starty + 318, 74, 55);
        button_10.setBackground(new Color(239, 239, 239));//import java.awt.Color;
        button_10.setForeground(Color.BLACK);
        button_10.setFocusPainted(false);
        frame.getContentPane().add(button_10);
        /*
		JButton button_11 = new JButton("#");
		button_11.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				addText("#");
			}
		});
		button_11.addKeyListener(new KeyAdapter() {
			@Override
			public void keyPressed(KeyEvent arg0) {
			}
		});
		button_11.setFont(new Font("Century Gothic", Font.PLAIN, 30));
		button_11.setBounds(startx+168,starty+318, 74, 55);
		frame.getContentPane().add(button_11);
         */
        JButton btnKyu = new JButton("Ky\u00E7u");
        btnKyu.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                 try {
            
            String pwd = new String(passwordField.getPassword())+"";
                        int psw=Integer.parseInt(pwd);
                        idcheck checkId=new idcheck(psw);
                        
                        if(checkId.idExists())
                        {
                            PatientInfo p=new PatientInfo(frame,checkId.getId());
                             
                        }else{
                             JOptionPane.showMessageDialog(frame,"Ky pasword nuk egziston");   
                        }
                                       

        } // Handle any errors that may have occurred.
        catch (NumberFormatException e) {
             JOptionPane.showMessageDialog(frame,"Shtypni paswordin");
            e.printStackTrace();
        }
                       

                //PatientInfo patientInfo = new PatientInfo(frame);
            }
        });
        btnKyu.setFont(new Font("Century Gothic", Font.PLAIN, 15));
        btnKyu.setBounds(startx, starty + 422, 3 * 74 + 20, 55);
        btnKyu.setBackground(new Color(214, 251, 255));//import java.awt.Color;
        btnKyu.setForeground(Color.BLACK);
        btnKyu.setFocusPainted(false);
        frame.getContentPane().add(btnKyu);
        
        
        JButton btnBack = new JButton("Kthehu mbrapa");
        btnBack.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
                new MainWindow();
              frame.dispose();
               
            }
        });
        btnBack.setBackground(new Color(214, 251, 255));//import java.awt.Color;
        btnBack.setForeground(Color.BLACK);
        btnBack.setBounds(startx, starty + 560, 3 * 74 + 20, 55);
        frame.getContentPane().add(btnBack);
    }

    public void addText(String text) {
        passwordField.setText(passwordField.getText() + text);
    }

}
