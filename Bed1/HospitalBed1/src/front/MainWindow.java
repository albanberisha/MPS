package front;

import back.config;
import back.data;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JLabel;
import java.awt.Font;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.Toolkit;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.util.Timer;
import java.util.TimerTask;
import javax.swing.BorderFactory;
import javax.swing.JOptionPane;
import javax.swing.border.Border;
import javax.swing.border.LineBorder;
import javax.swing.ImageIcon;
public class MainWindow {

    private JFrame frame;
Timer timer;
    /**
     * Launch the application.
     */
    public static void main(String[] args) {
        EventQueue.invokeLater(new Runnable() {
            public void run() {
                try {
                    new config();
                    MainWindow window = new MainWindow();
                    window.frame.setVisible(true);
                    
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        });
    }

    /**
     * Create the application.
     */
    public MainWindow() {
        initialize();
    }

    /**
     * Initialize the contents of the frame.
     */
    JLabel lblPacienti;
    JButton btnInformacioneMbiPacientin;

    public void initialize() {

        frame = new JFrame();
        frame.setExtendedState(JFrame.MAXIMIZED_BOTH);
        frame.setUndecorated(true);
        frame.setVisible(true);

        //frame.setBounds(0,0,1366, 768);
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.getContentPane().setLayout(null);
        lblPacienti = new JLabel();
        lblPacienti.setOpaque(false);
        lblPacienti.setForeground(new Color(255, 255, 255));
        lblPacienti.setFont(new Font("Century Gothic", Font.PLAIN, 120));
        Dimension screenSize = Toolkit.getDefaultToolkit().getScreenSize();
        // the screen height
        double x = screenSize.getHeight();

// the screen width
        double y = screenSize.getWidth();

        //lblPacienti.setHorizontalAlignment(JLabel.CENTER);
        data d = new data();
        String namesurname = d.getNameSurname();
        double xcenter = x / 2;
        double ycenter = y / 2;
        lblPacienti.setText(namesurname);
        Dimension sizee = lblPacienti.getPreferredSize();
        int xcenterpos = (int) (xcenter - (sizee.height / 2));
        int ycenterpos = (int) (ycenter - (sizee.width / 2));
        lblPacienti.setBounds(ycenterpos, xcenterpos, sizee.width + 10, sizee.height);
        frame.getContentPane().add(lblPacienti);

        btnInformacioneMbiPacientin = new JButton("Informacione mbi pacientin");
        btnInformacioneMbiPacientin.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent arg0) {
               timer2();
                Login login = new Login(frame);
            }
        });
        btnInformacioneMbiPacientin.setFont(new Font("Century Gothic", Font.PLAIN, 16));
        btnInformacioneMbiPacientin.setPreferredSize(new Dimension(300, 100));
        Dimension btnsizee = btnInformacioneMbiPacientin.getPreferredSize();
        btnInformacioneMbiPacientin.setFont(new Font("Serif", Font.BOLD, 20));
        btnInformacioneMbiPacientin.setBackground(new Color(0, 123, 255));//import java.awt.Color;
        btnInformacioneMbiPacientin.setForeground(Color.WHITE);
        btnInformacioneMbiPacientin.setFocusPainted(false);
        int heightbottompos = (int) (x - (btnsizee.height));
        int widthcenterpos = (int) (ycenter - (btnsizee.width / 2));
        btnInformacioneMbiPacientin.setBounds(widthcenterpos, heightbottompos, btnsizee.width, btnsizee.height);
        frame.getContentPane().add(btnInformacioneMbiPacientin);
        if (namesurname.equals("null null")) {
            btnInformacioneMbiPacientin.setVisible(false);
        } else {
            btnInformacioneMbiPacientin.setVisible(true);
        }
        setContent(frame);
        int MINUTES = 1; // The delay in minutes
        this.timer = new Timer();
        timer.schedule(new TimerTask() {
            @Override
            public void run() { // Function runs every MINUTES minutes.
                // Run the code you want here
                setContent(frame); // If the function you wanted was static
            }
        }, 0, 1000);

    }
    public void timer2()
    {
         timer.cancel();
timer.purge();
    }

    public void setContent(JFrame frame) {
        data d = new data();
        String condition = d.getcondition();
        String bed = d.getBed();
        String namesurname = d.getNameSurname();

        Color backcolor = new Color(214, 214, 214);
        if (condition != null) {
            switch (condition) {
                case "red":
                    backcolor = Color.RED;
                    break;
                case "green":
                    backcolor = Color.GREEN;
                    break;
                case "yellow":
                    backcolor = Color.YELLOW;
                    break;
            }
        } else {
            namesurname = "";
        }

        frame.getContentPane().setBackground(backcolor);
        lblPacienti.setText(namesurname);
        Dimension screenSize = Toolkit.getDefaultToolkit().getScreenSize();
        // the screen height
        double x = screenSize.getHeight();

// the screen width
        double y = screenSize.getWidth();

        //lblPacienti.setHorizontalAlignment(JLabel.CENTER);
        Dimension sizee = lblPacienti.getPreferredSize();
        double xcenter = x / 2;
        double ycenter = y / 2;
        int xcenterpos = (int) (xcenter - (sizee.height / 2));
        int ycenterpos = (int) (ycenter - (sizee.width / 2));
        lblPacienti.setBounds(ycenterpos, xcenterpos, sizee.width + 10, sizee.height);
        /*JLabel lblShtratiNumr = new JLabel("Shtrati num\u00EBr:");
		lblShtratiNumr.setForeground(Color.WHITE);
		lblShtratiNumr.setFont(new Font("Century Gothic", Font.PLAIN, 35));
		lblShtratiNumr.setBounds(10, 0, 276, 83);
		frame.getContentPane().add(lblShtratiNumr);
         */
        JLabel lblShtrati = new JLabel(bed);
        lblShtrati.setForeground(Color.WHITE);
        lblShtrati.setFont(new Font("Century Gothic", Font.PLAIN, 120));
        Dimension size = lblShtrati.getPreferredSize();
        lblShtrati.setBounds(10, 10, size.width, size.height);
        frame.getContentPane().add(lblShtrati);
        if (namesurname.equals("")) {
            btnInformacioneMbiPacientin.setVisible(false);
        } else {
            btnInformacioneMbiPacientin.setVisible(true);
        }
    }

}
