package Codigo;

import javax.swing.*;
import java.awt.*;

public class Calculadora extends JFrame {
    private JTextField pantalla;

    public Calculadora() {
        // Configuración básica del JFrame
        setTitle("Calculadora");
        setSize(300, 400);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        getContentPane().setLayout(new BorderLayout());

        // Crear la pantalla de la calculadora
        pantalla = new JTextField();
        pantalla.setEditable(false);
        getContentPane().add(pantalla, BorderLayout.NORTH);

        // Crear el panel de botones
        JPanel panel = new JPanel();
        panel.setLayout(new GridLayout(4, 4));

        // Crear botones con imágenes
        JButton btn1 = new JButton();
        btn1.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\icons8-1-48.png"));

        JButton btn2 = new JButton();
        btn2.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\icons8-2-48.png"));

        JButton btn3 = new JButton();
        btn3.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\icons8-3-48.png"));

        JButton btn4 = new JButton();
        btn4.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\icons8-4-48.png"));

        JButton btn5 = new JButton();
        btn5.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\icons8-5-c-48.png"));

        JButton btn6 = new JButton();
        btn6.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\icons8-6-c-48.png"));

        JButton btn7 = new JButton();
        btn7.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\icons8-7-c-48.png"));

        JButton btn8 = new JButton();
        btn8.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\numero-8 (2).png"));

        JButton btn9 = new JButton();
        btn9.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\icons8-9-48.png"));

        JButton btn0 = new JButton();
        btn0.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\icons8-0-48.png"));

        JButton btnSum = new JButton();
        btnSum.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\signo-de-mas.png"));

        JButton btnSub = new JButton();
        btnSub.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\menos.png"));

        JButton btnMul = new JButton();
        btnMul.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\signo-de-multiplicacion.png"));

        JButton btnDiv = new JButton();
        btnDiv.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\dividir.png"));

        JButton btnClear = new JButton();
        btnClear.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\borrar.png"));

        JButton btnEquals = new JButton();
        btnEquals.setIcon(new ImageIcon("C:\\Users\\lizar\\Downloads\\igual.png"));

        // Añadir botones al panel
        panel.add(btn7);
        panel.add(btn8);
        panel.add(btn9);
        panel.add(btnDiv);
        panel.add(btn4);
        panel.add(btn5);
        panel.add(btn6);
        panel.add(btnMul);
        panel.add(btn1);
        panel.add(btn2);
        panel.add(btn3);
        panel.add(btnSub);
        panel.add(btn0);
        panel.add(btnClear);
        panel.add(btnEquals);
        panel.add(btnSum);

        // Añadir el panel de botones al JFrame
        getContentPane().add(panel, BorderLayout.CENTER);

        // Configurar acciones de los botones
        btn1.addActionListener(e -> pantalla.setText(pantalla.getText() + "1"));
        btn2.addActionListener(e -> pantalla.setText(pantalla.getText() + "2"));
        btn3.addActionListener(e -> pantalla.setText(pantalla.getText() + "3"));
        btn4.addActionListener(e -> pantalla.setText(pantalla.getText() + "4"));
        btn5.addActionListener(e -> pantalla.setText(pantalla.getText() + "5"));
        btn6.addActionListener(e -> pantalla.setText(pantalla.getText() + "6"));
        btn7.addActionListener(e -> pantalla.setText(pantalla.getText() + "7"));
        btn8.addActionListener(e -> pantalla.setText(pantalla.getText() + "8"));
        btn9.addActionListener(e -> pantalla.setText(pantalla.getText() + "9"));
        btn0.addActionListener(e -> pantalla.setText(pantalla.getText() + "0"));

        btnClear.addActionListener(e -> pantalla.setText(""));
        btnSum.addActionListener(e -> pantalla.setText(pantalla.getText() + "+"));
        btnSub.addActionListener(e -> pantalla.setText(pantalla.getText() + "-"));
        btnMul.addActionListener(e -> pantalla.setText(pantalla.getText() + "*"));
        btnDiv.addActionListener(e -> pantalla.setText(pantalla.getText() + "/"));
        btnEquals.addActionListener(e -> calcular());
    }

    private void calcular() {
        try {
            String resultado = pantalla.getText();
            if (resultado.contains("+")) {
                String[] partes = resultado.split("\\+");
                pantalla.setText(String.valueOf(Double.parseDouble(partes[0]) + Double.parseDouble(partes[1])));
            } else if (resultado.contains("-")) {
                String[] partes = resultado.split("-");
                pantalla.setText(String.valueOf(Double.parseDouble(partes[0]) - Double.parseDouble(partes[1])));
            } else if (resultado.contains("*")) {
                String[] partes = resultado.split("\\*");
                pantalla.setText(String.valueOf(Double.parseDouble(partes[0]) * Double.parseDouble(partes[1])));
            } else if (resultado.contains("/")) {
                String[] partes = resultado.split("/");
                pantalla.setText(String.valueOf(Double.parseDouble(partes[0]) / Double.parseDouble(partes[1])));
            }
        } catch (Exception e) {
            pantalla.setText("Error");
        }
    }

    public static void main(String[] args) {
        Calculadora calc = new Calculadora();
        calc.setVisible(true);
    }
}
