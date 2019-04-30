/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author w4s22
 */
public class SavingsAccount {
    
    private double interestRate = 0.004F;
    private double balance;
    
    public SavingsAccount() {
        balance = 0.0F;
    }
    
    public SavingsAccount(double startingBalance) {
        balance = startingBalance;
    }
    
    double getBalance() {
        return balance;
    }
    
    void addInterest() {
        balance = balance + (interestRate * balance);
    }
    
    void makeDeposit(double depositAmount) {
        balance = balance + depositAmount;
    }
    
}
