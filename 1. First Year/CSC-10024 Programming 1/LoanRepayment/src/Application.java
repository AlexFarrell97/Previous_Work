/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author w4s22
 */
public class Application {
    
    public static void main(String[] args) {
        
        SavingsAccount JohnSavings = new SavingsAccount();
        CurrentAccount JohnCurrent = new CurrentAccount();
        LoanAccount JohnLoan = new LoanAccount(20000F);
        
        SavingsAccount MarySavings = new SavingsAccount(100);
        CurrentAccount MaryCurrent = new CurrentAccount();
        LoanAccount MaryLoan = new LoanAccount(20000F);
        
        //John
        double loanAmount = JohnLoan.getBalance();
        double loanDeposit = 200F;
        double amountLeft;
        int months = 0;
        
        do {
            amountLeft = monthlyActivity(2000, 1200, loanDeposit);
            JohnLoan.makePayment(loanDeposit);
            JohnCurrent.makeDeposit(amountLeft);
            loanAmount = JohnLoan.getBalance();
            JohnSavings.addInterest();
            JohnCurrent.addInterest();
            JohnLoan.addInterest();
            months++;
        } while (loanAmount > 0);
        
        System.out.println("John repaid his loan after " + months + " months. His current account balanace at that time was £" + JohnCurrent.getBalance());
        
        //Mary
        loanAmount = MaryLoan.getBalance();
        loanDeposit = 300F;
        months = 0;
        
        do {
            amountLeft = monthlyActivity(2000, 1000, loanDeposit);
            MaryLoan.makePayment(loanDeposit);
            MarySavings.makeDeposit(amountLeft);
            loanAmount = MaryLoan.getBalance();
            MarySavings.addInterest();
            MaryCurrent.addInterest();
            MaryLoan.addInterest();
            months++;
        } while (loanAmount > 0);
        
        System.out.println("Mary repaid her loan after " + months + " months. Her savings account balanace at that time was £" + MarySavings.getBalance());
    }
    
    static double monthlyActivity(double income, double outgoings, double loanDeposit) {
        income = income - outgoings - loanDeposit;
        return income;
    }
    
}
