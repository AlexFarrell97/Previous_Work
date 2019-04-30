import java.util.Random;

public class Deck
{
    Card[] cards;
    int nextCardIndex;
    
    public Deck()  // Constructor.
    {
        cards = new Card[52];

        cards[0] = new Card("A", "spades", 1);
        cards[1] = new Card("A", "diamonds", 1);
        cards[2] = new Card("A", "hearts", 1);
        cards[3] = new Card("A", "clubs", 1);

        int num = 2;
        for(int i = 4; i < 40; i = i+4) {
            cards[i] = new Card(Integer.toString(num), "spades", num);
            cards[i+1] = new Card(Integer.toString(num), "diamonds", num);
            cards[i+2] = new Card(Integer.toString(num), "hearts", num);
            cards[i+3] = new Card(Integer.toString(num), "clubs", num);
            num++;
        }

        cards[40] = new Card("J", "spades", 10);
        cards[41] = new Card("J", "diamonds", 10);
        cards[42] = new Card("J", "hearts", 10);
        cards[43] = new Card("J", "clubs", 10);

        cards[44] = new Card("Q", "spades", 10);
        cards[45] = new Card("Q", "diamonds", 10);
        cards[46] = new Card("Q", "hearts", 10);
        cards[47] = new Card("Q", "clubs", 10);

        cards[48] = new Card("K", "spades", 10);
        cards[49] = new Card("K", "diamonds", 10);
        cards[50] = new Card("K", "hearts", 10);
        cards[51] = new Card("K", "clubs", 10);
        
        shuffle();
        
        nextCardIndex = 0;
    }
    
    public Card drawCard()
    {
        if(nextCardIndex == cards.length) {  // If there are no cards left in the deck.
            return null;
        } else {
            Card card = cards[nextCardIndex];
            nextCardIndex++;
            
            return card;
        }
    }
    
    public void showCards()
    {
        for(int i = 0; i < cards.length; i++) {
            System.out.print(cards[i].name + cards[i].suit.toUpperCase().charAt(0) + ",");
        }
        System.out.print("\n");
    }
    
    public void shuffle() {
        Random rgen = new Random();
        
        for(int i=0; i<cards.length; i++) {
            int randomPosition = rgen.nextInt(cards.length);
            Card temp = cards[i];
            cards[i] = cards[randomPosition];
            cards[randomPosition] = temp;            
        }
    }    
            
    public static void main(String[] args) {

        Deck deck = new Deck();
        
        while(true) {
            Card card = deck.drawCard();
            if(card != null) {
                System.out.println(card.name + card.suit.toUpperCase().charAt(0));
                deck.showCards();
            } else {
                break;
            }
        }
    }
}
