/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author w4s22
 */
public class LoanAccount {
    
    private double interestRate = 0.006F;
    private double balance;
    
    public LoanAccount(double startingBalance) {
        balance = startingBalance;
    }
    
    double getBalance() {
        return balance;
    }
    
    void addInterest() {
        balance = balance + (interestRate * balance);
    }
    
    void makePayment(double amountPaid) {
        balance = balance - amountPaid;
    }
    
}
