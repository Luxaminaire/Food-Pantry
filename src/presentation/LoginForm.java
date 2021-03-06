package presentation;

import logic.Person;
import main.Controller;

import javax.swing.*;
import java.awt.*;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

public class LoginForm implements GUIForm {
    private JPanel rootPanel;
    private JTextField usernameField;
    private JPasswordField passwordField;
    private JButton loginbutton;
    private String username;
    private char[] password;

    public LoginForm()  {
        rootPanel.setPreferredSize(new Dimension(400, 500));

        loginbutton.addMouseListener(new MouseAdapter() {
            @Override
            public void mouseClicked(MouseEvent e) {
                username = usernameField.getText();
                password = passwordField.getPassword();
                if(usernameField.getText().isEmpty() || passwordField.getPassword().length <1){
                    JOptionPane.showMessageDialog(null, "Please Enter a Name and Password");
                } else {
                    Person currentUser = Person.authenticateStaffUser(username, password);

                    if(currentUser == null) {
                        JOptionPane.showMessageDialog(getRootPanel(),
                                "Invalid username or password."
                                ,"AUTHENTICATION ERROR", JOptionPane.ERROR_MESSAGE);
                    } else {
                        System.out.println("User " + currentUser.getFirstName() + " logged in successfully.");
                        Controller.setUser(currentUser);
                        // close current Login window
                        Controller.close();
                        // show main program GUI
                        Controller.showUI();
                    }
                }
            }
        });
    }

    @Override
    public JPanel getRootPanel() {
        return rootPanel;
    }
}
